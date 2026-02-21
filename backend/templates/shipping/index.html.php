<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Shipping Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; }
        .header-box { background: #0d6efd; color: white; border-radius: 15px 15px 0 0; padding: 2rem; }
        .btn-calc { border-radius: 10px; padding: 12px; font-weight: 600; text-transform: uppercase; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="header-box text-center">
                    <h2 class="mb-0">Zoo Shipping</h2>
                    <p class="mb-0 opacity-75">Швидкий розрахунок вартості</p>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Вага посилки (кг)</label>
                        <input type="number" id="weight" step="0.1" value="1.0" class="form-control form-control-lg">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Перевізник</label>
                        <select id="carrier" class="form-select form-select-lg">
                            <option value="transcompany">TransCompany (фіксований тариф)</option>
                            <option value="packgroup">PackGroup (тариф за вагу)</option>
                        </select>
                    </div>
                    <button onclick="calculate()" id="btn-text" class="btn btn-primary w-100 btn-calc mb-3">Розрахувати</button>
                    
                    <div id="result-box" class="d-none alert alert-success border-0 animate__animated animate__fadeIn">
                        <strong>Ціна: </strong> <span id="price" class="h4"></span> EUR
                    </div>
                    <div id="error-box" class="d-none alert alert-danger border-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function calculate() {
    const btn = document.getElementById('btn-text');
    const resultBox = document.getElementById('result-box');
    const errorBox = document.getElementById('error-box');
    
    resultBox.classList.add('d-none');
    errorBox.classList.add('d-none');
    btn.disabled = true;
    btn.innerText = 'Рахуємо...';

    try {
        const response = await fetch('/api/shipping/calculate', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                weightKg: document.getElementById('weight').value,
                carrier: document.getElementById('carrier').value
            })
        });
        const data = await response.json();
        if (data.error) throw new Error(data.error);
        
        document.getElementById('price').innerText = data.price;
        resultBox.classList.remove('d-none');
    } catch (err) {
        errorBox.innerText = err.message;
        errorBox.classList.remove('d-none');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Розрахувати';
    }
}
</script>
</body>
</html>
