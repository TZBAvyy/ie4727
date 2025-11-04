<style>
<?php
include './pages/admin.css';
?>
</style>

<div class="admin-container">
    <form action="./actions/adminHandler.php" method="post" class="admin-form">
        <input type="hidden" name="action" value="login">
        <h2>Login as Admin</h2>
        <div>
            <label for="username">Username: </label>
            <input type="username" required name="username" placeholder="root">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" required name="password" placeholder="xxxxxxxx">
        </div>
        <input type="submit">
    </form>
</div>