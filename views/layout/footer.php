</div> </div> </div> </div> </div> <footer class="bg-dark text-light mt-auto py-4"> <div class="container">
        <div class="row text-center text-md-start">
            
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-2"> <h5 class="text-uppercase mb-3 font-weight-bold text-primary" style="font-size: 1.1rem;">🚀 TaskMaster</h5>
                <p class="small mb-1">A simple and effective tool for managing daily tasks. Course project 2026.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <h6 class="text-uppercase mb-3 font-weight-bold text-primary" style="font-size: 0.9rem;">Menu</h6>
                <p class="small mb-1"><a href="index.php" class="text-light text-decoration-none">Homepage</a></p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <p class="small mb-1"><a href="?action=logout" class="text-light text-decoration-none">Logout</a></p>
                <?php else: ?>
                    <p class="small mb-1"><a href="?action=login" class="text-light text-decoration-none">Login</a></p>
                <?php endif; ?>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-2">
                <h6 class="text-uppercase mb-3 font-weight-bold text-primary" style="font-size: 0.9rem;">Contact</h6>
                <p class="small mb-1"><i class="fas fa-home me-2"></i> University Project, 2026</p>
                <p class="small mb-1"><a href="https://github.com/myzayy/MyToDoList2" class="text-light text-decoration-none" target="_blank">
                    <i class="fab fa-github me-2"></i> GitHub Repository
                </a></p>
            </div>

        </div>

        <hr class="my-3 opacity-25"> <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="small mb-0 opacity-75">
                    © 2026 Copyright: <strong class="text-primary">My To-Do List Project</strong>
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>