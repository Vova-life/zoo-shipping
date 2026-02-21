<template>
  <div style="font-family: sans-serif; padding: 20px;">
    <h1>ZOO Shipping Calculator</h1>
    
    <div>
      <label>Weight (kg): </label>
      <input v-model="weight" type="number" step="0.1" />
    </div><br/>

    <div>
      <label>Carrier: </label>
      <select v-model="carrier">
        <option value="transcompany">TransCompany</option>
        <option value="packgroup">PackGroup</option>
      </select>
    </div><br/>

    <button @click="calculate">Calculate price</button>

    <div v-if="result" style="margin-top: 20px; color: green;">
      <h3>Price: {{ result.price }} {{ result.currency }}</h3>
    </div>

    <div v-if="error" style="margin-top: 20px; color: red;">
      {{ error }}
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const weight = ref(1);
const carrier = ref('transcompany');
const result = ref(null);
const error = ref(null);

const calculate = async () => {
  error.value = null;
  result.value = null;
  try {
    const res = await fetch('http://localhost:8080/api/shipping/calculate', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ carrier: carrier.value, weightKg: parseFloat(weight.value) })
    });
    const data = await res.json();
    if (data.error) throw new Error(data.error);
    result.value = data;
  } catch (e) {
    error.value = e.message;
  }
};
</script>
