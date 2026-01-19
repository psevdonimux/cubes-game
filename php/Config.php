<?php
class Config{
	private static array $env = [];
	private static bool $loaded = false;
	public static function load(): void{
		if(self::$loaded) return;
		$path = __DIR__ . '/../.env';
		if(!file_exists($path)) return;
		$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach($lines as $line){
			if(str_starts_with(trim($line), '#')) continue;
			$parts = explode('=', $line, 2);
			if(count($parts) === 2){
				self::$env[trim($parts[0])] = trim($parts[1]);
			}
		}
		self::$loaded = true;
	}
	public static function get(string $key, string $default = ''): string{
		self::load();
		return self::$env[$key] ?? $default;
	}
	public static function dbHost(): string{ return self::get('DB_HOST', '127.0.0.1'); }
	public static function dbUser(): string{ return self::get('DB_USER', 'root'); }
	public static function dbPass(): string{ return self::get('DB_PASS', ''); }
	public static function dbName(): string{ return self::get('DB_NAME', 'box'); }
}
