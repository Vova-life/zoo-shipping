# ZOO Shipping Calculator Test Task

## Технології
- **Backend**: PHP 8.2 (Symfony 7)
- **Frontend**: Bootstrap 5 + Vanilla JS (інтегровано в Symfony для стабільності)
- **Infrastructure**: Docker (Nginx, PHP-FPM)
- **Testing**: PHPUnit

## Архітектурні рішення
- **Strategy Pattern**: Розрахунок вартості для кожного перевізника винесено в окремий клас. Це дозволяє легко додавати нових перевізників без зміни логіки сервісу-калькулятора.
- **Symfony Tagged Iterators**: Стратегії реєструються автоматично через Dependency Injection.
- **Unified Interface**: Фронтенд та API працюють на одному порті (8080), що виключає проблеми з CORS та забезпечує миттєву роботу інтерфейсу.

## Як запустити
1. Запустіть контейнери: `docker-compose up -d --build`
2. Встановіть залежності: `docker-compose exec php composer install`

## Доступ до проекту
- **Frontend UI**: [http://localhost:8080](http://localhost:8080)
- **API Endpoint**: `POST http://localhost:8080/api/shipping/calculate`

## Тестування
Проект покритий Unit-тестами:
`docker-compose exec php ./vendor/bin/phpunit tests`
