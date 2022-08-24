
<div class="col-sm-12 col-xs-12" style="overflow-x:auto;">
    <table class="table">
        <tr>
            <td>Username</td>
            <td><?php echo $username; ?></td>
            </tr>
        <tr>
            <td>User Password</td>
            <td><?php echo $user_password; ?></td>
            </tr>
        <tr>
            <td>User Nama Lengkap</td>
            <td><?php echo $user_nama_lengkap; ?></td>
            </tr>
        <tr>
            <td>User Jekel</td>
            <td><?php echo $user_jekel; ?></td>
            </tr>
        <tr>
            <td>User Alamat</td>
            <td><?php echo $user_alamat; ?></td>
            </tr>
        <tr>
            <td>User Email</td>
            <td><?php echo $user_email; ?></td>
            </tr>
        <tr>
            <td>User Kontak</td>
            <td><?php echo $user_kontak; ?></td>
            </tr>
        <tr>
            <td>User Status</td>
            <td><?php echo $user_status; ?></td>
            </tr>
        <tr>
            <td>User Photo</td>
            <td><?php echo $user_photo; ?></td>
            </tr>
        <tr>
            <td>Admin</td>
            <td><?php echo $admin; ?></td>
            </tr>
        <tr>
            <td>User Group Id</td>
            <td><?php echo $user_group_id; ?></td>
            </tr>
        <tr>
            <td></td>
            <td>
                <a href="<?php echo site_url('Users') ?>" class="btn btn-default">Cancel</a>
            </td>
        </tr>
    </table>
</div>