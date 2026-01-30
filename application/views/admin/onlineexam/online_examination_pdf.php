<style>
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 60%;
  padding: 4px;
}

.container
{
  width: 100%; 
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
 /* border: 1px solid #ddd;*/
}

th, td {
  text-align: left;
  padding: 6px;

  font-size:16px;
 
  font-family:Times New Roman;

}

tr:nth-child(even) {
  /*background-color: #f2f2f2;*/
}

.first_td
{
  width:160px;
  font-size:17px;
 
  font-family:Times New Roman;
  font-weight:700;

}

.second_td
{
  width:5px;
}

.third_td
{
  width:100px;
  margin-left: 0px;
}

</style>
</head>
<body>





<div class="container">

  <table>
  <tr>
  <td><img src="<?php echo base_url();?>payment_code/header.png" width="100%"></td>
  </tr>
  </table>
    
  </div>

  <div class="container">
   

  </div>




<div class="row">
  <div class="column">
    <h2 style="font-style: italic; text-decoration: underline;font-family: Kartika; ">Applied For   &nbsp; <?php echo $admission['admission_for_secondary'];?></h2>
<p><h2 style="font-style: normal;text-decoration:none !important; font-family: Times New Roman;"><?php echo $admission['admission_name'];?> </h2></p>
    <table>

     

     
      <tr>

    
     
      <tr>
        <td class="first_td">Date of Birth</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_dob'];?></td>
      </tr>
      <tr>
        <td class="first_td">Name of Father</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_fathername'];?></td>
      </tr>
      <tr>
        <td class="first_td">Name of Guardian:</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_guardian'];?></td>
      </tr>

      

      <tr>
        <td class="first_td">Relationship with Student</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_relationship'];?></td>
      </tr>

        <tr>
        <td class="first_td">Phone No</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_phoneno'];?></td>
      </tr>

    </table>

  </div>
  <div class="column" style="width:30%">
    <p style="border: 1px solid #000; text-align:center;"><b>Application No:<?php echo $admission['admission_application_no'];?></b></p>
    <table >
     
      
      <tr>
        <td><img src="<?php echo base_url();?>admissionphoto/<?php echo $admission['admission_photo'];?>" style="height:200px; width:200px;" ></td>
      
      </tr>
      

    </table>
  </div>
</div>
<hr style="color:#7ba7e9"></hr>

<div class="row">
  <div class="column">
    <table>
     
      <tr>
        <td class="first_td">House Name</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_housename'];?></td>
      </tr>
      <tr>
        <td class="first_td">Occupation of Father</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_fatheroccupation'];?></td>
      </tr>
      <tr>
        <td class="first_td">Name of Mother:</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_mothername'];?></td>
      </tr>

      

      <tr>
        <td class="first_td">Address:</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_address'];?></td>
      </tr>

    </table>
  </div>
  
</div>
<hr style="color:#7ba7e9"></hr>

<div class="row">
  <div class="column">
    <table>
     
      <tr>
        <td class="first_td">Adhaar No </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_adharno'];?></td>
      </tr>
      <tr>
        <td class="first_td">Thaluk</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_thaluk'];?></td>
      </tr>
      <tr>
        <td class="first_td">Village</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_village'];?></td>
      </tr>

      

      <tr>
        <td class="first_td">Mahallu</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_mahallu'];?></td>
      </tr>

       <tr>
        <td class="first_td">District</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_district'];?></td>
      </tr>

       <tr>
        <td class="first_td">State</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_state'];?></td>
      </tr>

      <tr>
        <td class="first_td">Are you an Orphan?</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_iforphan'];?></td>
      </tr>

        

    </table>
  </div>
  
</div>

<hr style="color:#7ba7e9"></hr>

<div class="row">
  <div class="column">
    <table>
     
      <tr>
        <td class="first_td">Last Studied Madrassa Class </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_laststudiedmadarsa'];?></td>
      </tr>
      <tr>
        <td class="first_td">Range No</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_range'];?></td>
      </tr>
      <tr>
        <td class="first_td">Last Studied School Class</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_laststudied'];?></td>
      </tr>

      

      <tr>
        <td class="first_td">Name of School</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_schoolname'];?></td>
      </tr>

       <tr>
        <td class="first_td">Medium</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_medium'];?></td>
      </tr>

       <tr>
        <td class="first_td">Identification Mark</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $admission['admission_identification'];?></td>
      </tr>

      

        

    </table>
  </div>
  
</div>
<hr style="color:#7ba7e9"></hr>
<br>
<br>
<br>
<br>
<br>

<div class="container">

    <table>
      <tr>
<td><img src="<?php echo base_url();?>payment_code/sathyaprasthanam.jpg" width="100%"></td>
        </tr>
      </table>
    
  </div>

<br>
<br>
<br>


 <div class="container" >
    <table>

      <tr><td style="width:60%;">Date: <b><?php echo $admission['admission_date'];?></b><br><br>Place: <b><?php echo $admission['admission_village'];?></b></td>
        <td style="width:40%;"><b>Signature:</b> <br><br><b>Name of Guardian: <?php echo $admission['admission_guardian'];?> </b></td>
      </tr>
    </table>
  
  </div>






