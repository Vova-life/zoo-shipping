<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0">
          <div class="card-header bg-primary text-white p-4">
            <h2 class="mb-0">Zoo Shipping Calculator</h2>
            <small>Professional shipping rates instantly</small>
          </div>
          <div class="card-body p-4">
            <!-- Input Weight -->
            <div class="mb-4">
              <label class="form-label fw-bold">Parcel Weight (kg)</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                <input v-model="weight" type="number" step="0.1" class="form-control form-control-lg" placeholder="0.0">
              </div>
            </div>

            <!-- Carrier Selection -->
            <div class="mb-4">
              <label class="form-label fw-bold">Select Carrier</label>
              <select v-model="carrier" class="form-select form-select-lg cursor-pointer">
                <option value="transcompany">TransCompany (Flat rates)</option>
                <option value="packgroup">PackGroup (Standard weight-based)</option>
              </select>
            </div>

            <!-- Submit Button -->
            <button @click="calculate" :disabled="loading" class="btn btn-primary btn-lg w-100 py-3 shadow-sm">
              <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
              {{ loading ? 'Calculating...' : 'Calculate Price' }}
            </button>

            <!-- Result Box -->
            <div v-if="result" class="alert alert-success mt-4 animate__animated animate__fadeIn">
              <div class="d-flex justify-content-between align-items-center">
                <span>Calculated Price:</span>
                <span class="h4 mb-0 fw-bold">{{ result.price }} {{ result.currency }}</span>
              </div>
            </div>

            <!-- Error Box -->
            <div v-if="error" class="alert alert-danger mt-4 d-flex align-items-center">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              {{ error }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const weight = ref(5.0);
const carrier = ref('transcompany');
const result = ref(null);
const error = ref(null);
const loading = ref(false);

const calculate = async () => {
  error.value = null;
  result.value = null;
  loading.value = true;
  
  try {
    const apiIP = window.location.hostname; // Автоматично бере IP роутера
    const res = await fetch(`http://${apiIP}:8080/api/shipping/calculate`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ carrier: carrier.value, weightKg: parseFloat(weight.value) })
    });

    if (!res.ok) {
       const errData = await res.json();
       throw new Error(errData.error || 'Server error');
    }

    const data = await res.json();
    result.value = data;
  } catch (e) {
    error.value = "Connectivity error. Make sure API at port 8080 is reachable.";
    console.error(e);
  } finally {
    loading.value = false;
  }
};
</script>

<style>
body { background-color: #f8f9fa; }
.card { border-radius: 15px; }
.btn-primary { border-radius: 10px; transition: all 0.3s; }
.btn-primary:hover { transform: translateY(-2px); }
</style>
