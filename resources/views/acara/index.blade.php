@extends('layouts.app')

@section('styles')    
<style>
    /* Tambahkan sedikit CSS untuk mengatur tampilan form */
    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }

    .form-navigation {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6>List Data Pasien</h6>
        </div>
        <div class="card-body">
            <form id="multiStepForm">
                <!-- Step 1 -->
                <div id="step1" class="form-step active">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
        
                <!-- Step 2 -->
                <div id="step2" class="form-step">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
        
                <!-- Step 3 -->
                <div id="step3" class="form-step">
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                </div>
        
                <!-- Step 4 -->
                <div id="step4" class="form-step">
                    <div class="form-group">
                        <label for="notelpon">Nomor Telepon:</label>
                        <input type="tel" class="form-control" id="notelpon" name="notelpon" required>
                    </div>
                </div>
        
                <!-- Navigation Buttons -->
                <div class="form-navigation mt-3">
                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)" disabled>Sebelumnya</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    let currentStep = 1;

    function showStep(step) {
        const steps = document.querySelectorAll('.form-step');
        steps.forEach((stepElement, index) => {
            stepElement.classList.toggle('active', index + 1 === step);
        });

        // Mengontrol tombol navigasi
        document.getElementById('prevBtn').disabled = step === 1;
        document.getElementById('nextBtn').textContent = step === steps.length ? 'Submit' : 'Selanjutnya';
    }

    function nextPrev(direction) {
        const steps = document.querySelectorAll('.form-step');

        if (direction === 1 && !validateForm()) {
            return false; // Tidak bisa lanjut ke langkah berikutnya jika inputan tidak valid
        }

        currentStep += direction;

        if (currentStep > steps.length) {
            document.getElementById("multiStepForm").submit(); // Submit form jika langkah terakhir selesai
            return false;
        }

        showStep(currentStep);
    }

    function validateForm() {
        const currentInputs = document.querySelectorAll('.form-step.active input');
        let valid = true;

        currentInputs.forEach(input => {
            if (!input.checkValidity()) {
                input.reportValidity();
                valid = false;
            }
        });

        return valid;
    }

    showStep(currentStep);
</script>
@endsection
