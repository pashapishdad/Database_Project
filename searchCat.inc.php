<?php
if(isset($_POST['search-submit'])){
	
	require 'dbh.inc.php';
	
	$search = $_POST['search'];
    
    if(empty($search)){
        
        header("Location: searchCat.php?error=emptyfield");
        exit();
    }
    
    else{
        $sql = "select jID, name, description, category, salary from job where category like ? group by jID";
        //$sql = "select * from job where name=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: searchCat.php?error=sqlerror");
            exit();
        }
        else{
            $search2 = '%'.$search.'%';
            mysqli_stmt_bind_param($stmt, "s", $search2);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($rows = mysqli_fetch_all($result, MYSQLI_ASSOC)){
                require "searchCat.php";
                echo'<br>';
                foreach( $rows as $row ) {
//                    foreach ($row as $key=>$item){
//                        echo "$key: $item --- ";
//                    }
                    echo "<table>
                            <tr>";
                    foreach ($row as $key=>$item){
                        echo "<th>$key</th>";
                    }
                    echo "</tr><tr>";
					$count = 0;
                    foreach ($row as $key=>$item){
						if($count == 0){
							$jID = $item;
						}
                        $item = "---".$item."---";
                        echo "<td>$item</td>";
						$count++;
                    }
//                    print_r($row);
//                    foreach( $row as $col ) {
//                        echo "name: ".$col;
//                        echo "description: ".$col;
//                        echo "category: ".$col;
//                        echo "salary: ".$col;
//                    }
                    echo"</tr></table>";
                    
					echo'<form action="applyJob.inc.php" method="POST">
							<input type="hidden" name="jID" value ="'.$jID.'" />
							<input type="submit" name="apply" value="Apply for job" />
						</form><br>';
                }
                //header("Location: searchCat.php?error=test");
                exit();

            }
            else{
                header("Location: searchCat.php?error=noresult");
                exit();
            }
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($conn);
        }
    }
}
