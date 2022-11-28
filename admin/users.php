<?php

include("includes/header.php");

if (!$session->isSignedIn()) {
    redirect("login.php");
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <a href="create_user.php"><button class="btn btn-primary">Add Users</button></a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID#</th>
                <th scope="col">Username</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col"> Action </th>
            </tr>
        </thead>
        <tbody>
            <?php

                if (isset($_POST['search'])){
                    $user = new User();
                    $users = $user->searchUser($_POST['keyword'], 'username');
                } else {
                    $users = User::getAll();
                }
            foreach ($users as $user) {
            ?>
                <tr>
                    <th scope="row"><?php echo $user->id ?></th>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->firstname; ?></td>
                    <td><?php echo $user->lastname; ?></td>
                    <td><a href="update_user.php?id=<?php echo $user->id; ?>">Edit<a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("includes/footer.php"); ?>
