<?php
ob_start();
session_start();
include_once 'template/header.php';
include_once 'database/connection.php';

$message = $_SESSION['message'] ??  "";

// remove message
unset($_SESSION['message']);

?>

<main class="container my-3">

    <h6 class="display-6 text-center text-info mb-2">
        To-Do List
    </h6>

    <!-- Message -->
    <div>
        <?php if ($message): ?>
        <div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Waring: </strong>
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Create Todo List Item -->
    <form action="list.php" method="post">

        <div class="mb-3">
            <input class="form-control" type="text" name="item" placeholder="Enter Somethig">
        </div>

        <div class="text-end">
            <button class="btn btn-outline-primary" type="submit" name="add">Add</button>

        </div>
    </form>

    <?php
    $conn = getConnection();
    $query = "select * from lists order by id DESC";
    $lists = mysqli_query($conn, $query);
    ?>

    <!-- Show all items -->
    <ul class="list-group mt-3">
        <?php foreach ($lists as $list): ?>
        <li class="list-group-item">
            <?= $list['item'] ?>

            <div class="float-end">
                <a href="edit.php?id=<?= $list['id'] ?>" class="btn btn-outline-info">Edit</a>
                <a href="list.php?delete=<?= $list['id'] ?>" class="btn btn-outline-danger ">Delete</a>
            </div>

        </li>

        <?php endforeach; ?>
    </ul>


</main>



<?php
include_once 'template/footer.php';
ob_flush();
?>