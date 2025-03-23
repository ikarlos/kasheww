<?php
include "./partials/header.php"; ?>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="./login-backend.php" method="POST" class="bg-white p-5 rounded shadow" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Login</h2>



            <div class="mb-4">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control border-2 border-secondary py-2 px-3 rounded-pill" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control border-2 border-secondary py-2 px-3 rounded-pill" required>
            </div>

            <button type="submit" class="btn btn-primary border-2 border-secondary py-2 px-4 rounded-pill text-white w-100">Login</button>
        </form>
    </div>
</body>
<?php include "./partials/footer.php"; ?>
