<br /><br />
<?php
    include_once 'app/contact.php';
    $id=$_GET['id'];
    $obj=new contact();
    $obj->set_tbl('contact_tbl');
    $result=$obj->show_edit_data($id);
    if(isset($_POST['btnA'])){
        $data=$_POST['frm'];
        $filds=array_keys($data);

        $obj->edit_data($filds,$data , $id);
        include_once 'list.php';
        
    }
?>

<h1 class="pageLables">افزودن شماره تماس جدید</h1>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2" >
        <section class="panel">
            <header class="panel-heading">
                افزودن شماره تماس جدید
            </header>
            <div class="panel-body">
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام</label>
                        <input type="text" name="frm[name]" class="form-control" value="<?php echo $result['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام خانوادگی</label>
                        <input type="text" name="frm[lastname]" class="form-control"  value="<?php echo $result['lastname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">شماره تماس</label>
                        <input type="text" name="frm[tel]" class="form-control"  value="<?php echo $result['tel']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">آدرس</label>
                        <input type="text" name="frm[address]" class="form-control"  value="<?php echo $result['address']; ?>">
                    </div>
                    <button type="submit" name="btnA" class="btn btn-info">افزودن</button>
                </form>

            </div>
        </section>
    </div>
</div>
