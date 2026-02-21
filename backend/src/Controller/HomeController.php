<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    #[Route('/', name: 'app_home')]
    public function index(): Response {
        $html = '<!DOCTYPE html>
        <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <title>Zoo Shipping</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body { background: #f0f2f5; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
                .card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; width: 450px; }
                .bg-header { background: #0d6efd; color: white; border-radius: 20px 20px 0 0; padding: 25px; }
                .btn-calc { border-radius: 12px; font-weight: bold; padding: 12px; }
            </style>
        </head>
        <body>
            <div class="card shadow-lg">
                <div class="bg-header text-center">
                    <h2 class="mb-0">Zoo Shipping</h2>
                    <small class="opacity-75">Калькулятор доставки</small>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Вага посилки (кг)</label>
                        <input type="number" id="weight" value="5.0" step="0.1" class="form-control form-control-lg">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Перевізник</label>
                        <select id="carrier" class="form-select form-select-lg">
                            <option value="transcompany">TransCompany (Flat rates)</option>
                            <option value="packgroup">PackGroup (Standard weight)</option>
                        </select>
                    </div>
                    <button onclick="calculate()" id="btn" class="btn btn-primary btn-lg w-100 btn-calc">РОЗРАХУВАТИ</button>
                    
                    <div id="res" class="d-none mt-4 p-3 bg-light rounded text-center">
                        <div class="text-muted small">Результат:</div>
                        <div class="h2 mb-0 fw-bold text-primary"><span id="price"></span> EUR</div>
                    </div>
                    <div id="err" class="d-none mt-3 alert alert-danger border-0"></div>
                </div>
            </div>

            <script>
            async function calculate() {
                const r=document.getElementById("res"), e=document.getElementById("err"), b=document.getElementById("btn");
                r.classList.add("d-none"); e.classList.add("d-none"); b.disabled=true; b.innerText="Обробка...";
                try {
                    const response = await fetch("/api/shipping/calculate", {
                        method: "POST",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify({
                            weightKg: document.getElementById("weight").value,
                            carrier: document.getElementById("carrier").value
                        })
                    });
                    const d = await response.json();
                    if (d.error) throw new Error(d.error);
                    document.getElementById("price").innerText = d.price;
                    r.classList.remove("d-none");
                } catch(err) { e.innerText=err.message; e.classList.remove("d-none"); }
                finally { b.disabled=false; b.innerText="РОЗРАХУВАТИ"; }
            }
            </script>
        </body></html>';
        return new Response($html);
    }
}
