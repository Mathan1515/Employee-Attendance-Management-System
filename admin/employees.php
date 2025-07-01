<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Employees</h4>
                    </div>
                    
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-employee.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Employee</a>
                    </div>
                
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['ids'])){
                                        $id = $_GET['ids'];
                                        $delete_query = mysqli_query($connection, "delete from tbl_employee where id='$id'");
                                        }
                                        $fetch_query = mysqli_query($connection, "select * from tbl_employee where role=0");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php if(!empty($row['profile_image']) && file_exists($row['profile_image'])) { ?>
                                                    <img src="<?php echo $row['profile_image']; ?>" alt="Profile" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                                <?php } else { ?>
                                                    <img src="assets/img/user.jpg" alt="Profile" class="rounded-circle" width="40" height="40">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['emailid']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            
                                            <td>
                                                <span class="custom-badge status-grey"><?php echo $row['department'];?></span>
                                            </td>
                                                <td><?php if($row['status']=="1"){ ?>
                                                    <span class="custom-badge status-green">Active</span>
                                                <?php } else{ ?>
                                                    <span class="custom-badge status-red">Inactive</span>
                                                <?php } ?>
                                                </td>
                                            <td class="text-right">
                                                <a href="edit-employee.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="employees.php?ids=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                </div>
            </div>
        </div>
<?php include('footer.php'); ?>
