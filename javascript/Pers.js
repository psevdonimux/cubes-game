const LERP_SPEED = 0.15;
const DEFAULT_SIZE = 40;
const DEFAULT_SPEED = 3;

class Pers{
	constructor(ctx, canvas, obj){
		this.ctx = ctx;
		this.canvas = canvas;
		this.obj = obj;
		this.targetX = obj.x;
		this.targetY = obj.y;
		this.velocityX = 0;
		this.velocityY = 0;
	}
	draw(){
		this.ctx.fillStyle = this.obj.color;
		this.ctx.fillRect(this.obj.x, this.obj.y, this.obj.width, this.obj.height);
		this.ctx.strokeStyle = '#fff';
		this.ctx.lineWidth = 2;
		this.ctx.strokeRect(this.obj.x, this.obj.y, this.obj.width, this.obj.height);
		this.ctx.fillStyle = '#fff';
		this.ctx.font = 'bold ' + Math.floor(this.obj.width * 0.5) + 'px Arial';
		this.ctx.textAlign = 'center';
		this.ctx.textBaseline = 'middle';
		this.ctx.fillText(this.obj.num, this.obj.x + this.obj.width / 2, this.obj.y + this.obj.height / 2);
	}
	clear(){
		this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
	}
	update(clear = true){
		if(clear) this.clear();
		this.draw();
	}
	setXY(x, y){
		this.obj.x = Number(x);
		this.obj.y = Number(y);
	}
	setTargetXY(x, y){
		var newX = Number(x);
		var newY = Number(y);
		this.velocityX = newX - this.targetX;
		this.velocityY = newY - this.targetY;
		this.targetX = newX;
		this.targetY = newY;
	}
	lerp(){
		this.obj.x += (this.targetX - this.obj.x) * LERP_SPEED;
		this.obj.y += (this.targetY - this.obj.y) * LERP_SPEED;
	}
	predict(){
		this.targetX += this.velocityX * 0.3;
		this.targetY += this.velocityY * 0.3;
	}
	getX(){ return this.obj.x; }
	getY(){ return this.obj.y; }
	setX(x){ this.obj.x = x; }
	setY(y){ this.obj.y = y; }
	addX(step){ this.obj.x += step; }
	addY(step){ this.obj.y += step; }
	reduceX(step){ this.obj.x -= step; }
	reduceY(step){ this.obj.y -= step; }
	getWidth(){ return this.obj.width; }
	getHeight(){ return this.obj.height; }
	getSpeed(){ return this.obj.speed; }
	addSize(size, clear = true){
		this.obj.width += size;
		this.obj.height += size;
		this.update(clear);
	}
}
