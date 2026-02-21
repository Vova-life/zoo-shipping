# Список виконаних завдань згідно з ТЗ (ZOO Shipping)

### 1. Бізнес-логіка та архітектура
- [x] **Патерн Strategy**: Реалізовано інтерфейс CarrierStrategyInterface.
- [x] **Concrete Strategies**: Реалізовано логіку для TransCompany (фіксована ціна за порогом ваги) та PackGroup (1 EUR за 1 кг).
- [x] **Open/Closed Principle**: Додавання нового перевізника не вимагає зміни існуючого коду калькулятора.
- [x] **DI & Tagged Iterators**: Використано механізм Symfony для автоматичної реєстрації нових стратегій у ShippingCalculator.

### 2. Backend (Symfony API)
- [x] **API Endpoint**: Створено POST /api/shipping/calculate.
- [x] **Validation**: Додано валідацію вхідних даних (вага та slug перевізника).
- [x] **Error Handling**: Реалізовано повернення JSON помилок (400) у разі неправильних даних або непідтримуваного перевізника.

### 3. Frontend (Vue.js)
- [x] **Minimal UI**: Реалізовано форму з числовим інпутом для ваги та select-меню для вибору перевізника.
- [x] **Reactive Updates**: Результат розрахунку (ціна/помилка) відображається без перезавантаження сторінки.

### 4. Інфраструктура (Docker)
- [x] **Orchestration**: Створено docker-compose.yml для запуску проекту.
- [x] **Nginx Container**: Налаштовано для обслуговування Symfony.
- [x] **PHP-FPM Container**: PHP 8.2 з усіма необхідними модулями.
- [x] **UI Container**: Node.js середовище для розробки та запуску Vue (Vite).

### 5. Тестування (PHPUnit)
- [x] **Unit Tests**: Створено тести для кожної стратегії розрахунку (Unit tests).
- [x] **Success Confirmation**: Тести підтверджено: "OK (2 tests, 5 assertions)".

### 6. Доставка (Deliverables)
- [x] **README.md**: Додано інструкції з запуску.
- [x] **Source Code**: Проект підготовлено у Git-репозиторій.
