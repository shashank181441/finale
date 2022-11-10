<?php
// include "../dbconn.php";
// $query1 = "select * from add_rest where rest_id = 55";
// $sql = mysqli_query($conn, $query1);
// if (mysqli_num_rows($sql) > 0) {
//     // output data of each row
//     while ($row = mysqli_fetch_assoc($sql)) {



//         $json_data = $row['menus'];

//         $json = json_decode($json_data, true);
//         print_r($json);
//         display_array_recursive($json);
//         function display_array_recursive($json_rec)
//         {
//             if ($json_rec) {
//                 foreach ($json_rec as $key => $value) {
//                     if (is_array($value)) {
//                         display_array_recursive($value);
//                     } else {
//                         echo $key . '--' . $value . '<br>';
//                     }
//                 }
//             }
//         }
//     }}

$json_string='[{
    "category": "momo",
    "foods": [{
            "name": "Veg MOMO",
            "price": 320,
            "image": "images/dfd.png"
        },
        {
            "name": "Buff Momo",
            "price": 420,
            "image": "images/dfd.png"
        },
        {
            "name": "Chicken momo",
            "price": 520,
            "image": "images/dfd.png"
        }
    ]
},
{
    "category": "Chaumein",
    "foods": [{
            "name": "Veg Chaumein",
            "price": 50,
            "ïmage": "images/dfd.png"

        },
        {
            "name": "Chicken Chaumein",
            "price": 100,
            "ïmage": "images/dfd.png"

        }
    ]
}
]';
echo $json_string;
                    require "../dbconn.php";
                    $query1 = "select * from add_rest where rest_id = 55";
                    $sql = mysqli_query($conn, $query1);
                    print_r( $sql);
                     $norows=mysqli_num_rows($sql);
                     echo $norows;
                    if ($norows > 0) {
                        // output data of each row
                            while ($row = mysqli_fetch_assoc($sql)) {
                    echo '<br><br>';
                    $json_array=json_decode($json_string,true); 


                    print_r($json_array);
                    echo '<br><br>';
                    //arr($json_array);
                            }
                        }


                    //function arr($json_re){
                       // if($json_re){
                       ///     foreach($json_re as $key=> $value){
                         ///       if(is_array($value)){
                          //          arr($value);
                          //      }else{
                          //          echo $key.'--'.$value.'<br>';
                          //      }	
                          //  }	
//}	
                  //  }         }
            //}