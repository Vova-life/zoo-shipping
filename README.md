# ZOO Shipping Calculator Test Task

## Технології
- **Backend**: PHP 8.2 (Symfony)
- **Frontend**: Vue.js 3 (Vite)
- **Infrastructure**: Docker (Nginx, PHP-FPM, UI)
- **Testing**: PHPUnit

## Архітектурні рішення
- Реалізовано патерн **Strategy** для розрахунку вартості доставки (відповідає принципу Open/Closed).
- Використано **Dependency Injection** та **Tagged Iterators** для автоматичної реєстрації нових стратегій. Система максимально гнучка: додавання нового перевізника потребує лише створення нового класу без редагування основного коду калькулятора.
- Реалізовано валідацію вхідних даних на рівні API.

## Як запустити
1. Переконайтеся, що Docker встановлений.
2. Запустіть контейнери: `docker-compose up -d --build`
3. Встановіть бібліотеки бекенду: `docker-compose exec php composer install`
4. Встановіть бібліотеки фронтенду (якщо не встановилися автоматично): `docker-compose exec ui npm install`

## Тестування
Проект покритий Unit-тестами для перевірки бізнес-логіки розрахунків:
`docker-compose exec php ./vendor/bin/phpunit tests`

## API Endpoints
- **URL**: `/api/shipping/calculate`
- **Method**: `POST`
- **Request Body**: `{"carrier": "transcompany", "weightKg": 10}`
- **Response Success**: `{"carrier": "transcompany", "weightKg": 10, "currency": "EUR", "price": 20}`

## Frontend UI
Інтерфейс доступний за адресою: `http://localhost:5173` (або по IP сервера)
