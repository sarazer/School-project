<?php
require_once 'models/AdminModel.php';
    
Class Render {


    //render 2 parms every time
    function ParmsView() { 
        $render = new AdminModel(); 
        echo '<div class="container-fluid">
                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                <h2>Administrators:
                <a href="'.DIR.'index.php?page=adminView&action=insertNewAdmin"><i class="fa fa-plus-square"></a></i>
                </h2><br>';
                    
        $displayAdmins = $render->getAdmins();
            foreach ($displayAdmins as $admin) {
            echo '<div class="box"><a href="'.DIR.'index.php/?page=adminView&action=adminDetails&id='.$admin['adminId'].'">' .$admin['adminName'].'</a>, </br>'.
            '<img src="'.DIR.'upload/'.$admin['adminImage'].'"/>'.  $admin['adminPhone']  . '</br>'.  $admin['adminRole']  . '</br>'.  $admin['adminEmail']  .'</div></br>';
        };

		echo '</div>
            <div class="col-md-5">';
    }

    function mainView() {
        $render = new AdminModel();
        $show = $this->ParmsView(); 
        $display = $render->getNumOfAdmin();

        echo 'Total administrators: '.$display['total'];

    }
}

Class AdminView extends Render {

    //  show admin details
    function viewDetails($id) { 
        $render = new AdminModel();

        $show = $this->ParmsView();

        $displayAdmin = $render->getAdmin($id);
        foreach ($displayAdmin as $admin) {
            echo '<h3>'.$admin['adminName']. '  ('. $admin['adminRole']. ')'. '<img src="'.DIR.'upload/'.$admin['adminImage'].'"/>';

            if ((($_SESSION['role'] == 'owner') && ($admin['adminRole'] == 'sales' || 'manager'))
            || (($_SESSION['role'] == 'manager') && ($admin['adminRole'] == 'sales'))) {
                echo ' <a href="'.DIR.'index.php?page=adminView&action=updateAdmin&id='.$id.'"><i class="glyphicon glyphicon-edit"></i></a>';
            } 
            echo '</h3>' .'<h4>Phone: </h4>'.$admin['adminPhone'] .'</br></br>'.
            '<h4>Email: </h4>'.$admin['adminEmail'] .'</br>';
        }

        echo '</div>
            </div>
            </div>';
    }
   
    
    function insertView() {
        $render = new AdminModel();
        $show = $this->ParmsView();
        echo '
        <h3>Insert New Administrator</h3>
        <hr>
        <form class="form-group" action="" method="POST" >
            <label>Name:<br>
            <input class="form-control" type="text" placeholder="name" name="name"></label></br>
            <label>Phone:<br>
            <input class="form-control" type="number" placeholder="phone" name="phone"></label></br>
            <label>Email:<br>
            <input class="form-control" type="email" placeholder="email" name="email"></label></br>
            <div>';
            
            if ($_SESSION['role']=='owner') {
                echo '<label>Role: </label><br>
                <select name="role">
                    <option value="sales">Sales</option>
                    <option value="manager">Manager</option>
                    
                </select> <br></br>';
                   
                     
            }

            echo '<br><input  class="btn btn-default btn-file" id="fileUpload" name="image" multiple="" type="file" /><br>
            <input type="submit" class="btn btn-primary input-group" name="submit" value="Submit">
        </form>
        <br>
            ';
            echo '</div>
             </div>
            </div>';
    
    }




    function updateView($id) {
        $render = new AdminModel();
        $show = $this->ParmsView();
        
        $admins = $render->getAdmin($id);
        
                foreach ($admins as $admin) {
                    echo '
                    <h3>Update '.$admin['adminName'];
        
                    if ($_SESSION['role']=='owner') {
                        echo ' <a href="'.DIR.'index.php?page=adminView&action=deleteAdmin&id='.$admin['adminId'].'"><i class="glyphicon glyphicon-trash"></i></a></h2>';
                    } else echo '</h3>';
                    
                    echo '<hr> <form class="form-group" action="" method="POST" >
                        <label> Name:<br>
                        <input class="form-control" type="text"  placeholder="name" name="name" value="'.$admin['adminName'].'"></input></label><br>
                        <label>Phone:<br>
                         <input class="form-control" type="text"  placeholder="phone" name="phone" value="'.$admin['adminPhone'].'"></input></label><br>
                        <label>Email:<br>
                         <input class="form-control" type="text" placeholder="email" name="email" value="'.$admin['adminEmail'].'"></input></label><br>';
                        
                        if ($_SESSION['role']=='owner') {
                            echo '<label>Role:</label></br>
                                     <select name="role">
                                        <option value="sales">Sales</option>
                                        <option value="manager">Manager</option>
                                    </select><br><br>';
                                    
                        }
                        echo '<br><input  class="btn btn-default btn-file" id="fileUpload" name="image" multiple="" type="file" /><br>
                        <input type="submit" class="btn btn-primary input-group" name="submit" value="Submit"></form>';
                    }
        
                    echo '</div>
                    </div>
                    </div>';

    }
} 

?>