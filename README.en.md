[Русский](README.md) | [English](README.en.md)

# Cubes Game

Multiplayer browser game with cubes on Canvas.

## Installation

```bash
curl -sL https://raw.githubusercontent.com/psevdonimux/cubes-game/main/installer.sh | bash
```

## Configuration

1. Edit `.env`:
```
DB_HOST=localhost
DB_USER=root
DB_PASS=your_password
DB_NAME=box
```

2. Start MariaDB:
```bash
mysqld_safe &
```

3. Create user (first run):
```bash
mysql -u root
ALTER USER 'root'@'localhost' IDENTIFIED BY 'your_password';
FLUSH PRIVILEGES;
exit
```

4. Start PHP server:
```bash
php -S localhost:8080
```

## Screenshots

| Menu |
|------|
| ![Menu](screenshots/menu.webp) |

| Game |
|------|
| ![Game](screenshots/play.webp) |

## Requirements

- PHP 8.0+
- MariaDB 10.5+
