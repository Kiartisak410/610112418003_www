<?php 
    require "../modules/conDB.php "
?>
<br>
<div class="form-control col-4">
<div class="form-group">
    <button id="btn_add_member" class="btn btn-primary">Add</button>
</div>
<br>
<center>
<div class="form-group col-4">
<table class="table table-dark table-hover">
    <thead>
        <th>#</th>
        <th>EMAIL</th>
        <th>NAME</th>
        <th>YEAR</th>
        <th>AGE</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM tb_member";
        $members = $mysqli->query($sql);
        $no = 1;
        while($member = $members->fetch_row()){
        ?>
        <tr>
        <td><?= $no++ ?></td>
        <td><?= $member[0] ?></td>
        <td><?= $member[1] . $member[2] ?></td>
        <td><?= $member[3] ?></td>
        <td><?= date("Y") - $member[3] ?></td>
        <td>
            <button class="btn_del btn btn-danger" data="<?= $member[0] ?>">Delete</button>
        </td>
        </tr>
        <?php
        }
        ?>

    </tbody>
</table>
</div>
</center>
</div>
<script>
    $(".btn_del").click(function(){
        let email = $(this).attr("data");

        Swal.fire({
            title: 'Are you sure?',
            text: `ลบข้อมูลอีเมล์ ${email}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm:function(){
                $.ajax({
                    url: "./models/delMember.php",
                    method: "POST",
                    cache: false,
                    data: {
                        email: email
                    },
                    success: function() {
                        $("#div_content").load("./views/member.php");
                    }
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                        'success'
        )}})
    });

    $("#btn_add_member").click(function(){
        $("#div_content").load("./views/addMember.html");
    });
</script>