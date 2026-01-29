<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}



.tableclas
{
   border: 1px black solid; 
   width:50%;
}
 


.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
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
  /*border: 1px solid #ddd;*/
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  /*background-color: #f2f2f2;*/
}

.first_td
{
    width:40px;
}

.third_td
{
    width:60px;
}
</style>
</head>
<body>
    
    
   

<p><img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="100%" height="160"></p>

<hr></hr>


<div class="row">
  <div class="column">
   

    <table>
       <tr>
        <td class="first_td">Name Of Student&nbsp;&nbsp;:&nbsp;</td>
        
        
        <td class="third_td"><?php echo $admission['admission_name'];?></td>
      </tr>
        
        
        
         <tr>
        <td class="first_td">House Name&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_housename'];?></td>
      </tr>
        
      <tr>
        <td class="first_td">Name of Father&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_fathername'];?></td>
      </tr>
      
      <tr>
        <td class="first_td">Job of Father&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_fatheroccupation'];?></td>
      </tr>
      
      
        <tr>
        <td class="first_td">Address&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_address'];?></td>
      </tr>
      
      
      <tr>
        <td class="first_td">Name of Mother&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_mothername'];?></td>
      </tr>
    </table>
  </div>
  <div class="column">
    <table>
      <tr>
        <td style="text-align:center"><img src="<?php echo base_url();?>entrance/admissionphoto/<?php echo $admission['admission_photo'];?>" style="height:160px; width:140px;" ></td>
      
      </tr>
      
      <tr>
        <td style="text-align:center" class="first_td">Date of Birth&nbsp;&nbsp;:&nbsp;<?php echo $admission['admission_dob'];?><br>
        
         House Name Of Mother&nbsp;&nbsp;:&nbsp;<?php echo $admission['admission_motherhousename'];?>
        </td>
        
        
       
      </tr>
      
      
      
    </table>
    
    
  </div>
</div>
<hr></hr>




<div class="row">
  <div class="column">
    <table>
     <tr>
        <td class="first_td">Adhaar No &nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_adharno'];?></td>
      </tr>
      <tr>
        <td class="first_td">Thaluk&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_thaluk'];?></td>
      </tr>
      <tr>
        <td class="first_td">Village&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_village'];?></td>
      </tr>

      

      <tr>
        <td class="first_td">Mahallu&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_mahallu'];?></td>
      </tr>

       <tr>
        <td class="first_td">District&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_district'];?></td>
      </tr>

       <tr>
        <td class="first_td">State&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_state'];?></td>
      </tr>

      <tr>
        <td class="first_td">Are you an Orphan?&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_iforphan'];?></td>
      </tr>
    </table>
  </div>
  <div class="column">
    <table>
      <tr>
        <td class="first_td">Last Studied Madrassa Class&nbsp;&nbsp;:&nbsp;
        </td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_laststudiedmadarsa'];?></td>
      </tr>
      <tr>
        <td class="first_td">Range No&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_range'];?></td>
      </tr>
      <tr>
        <td class="first_td">Last Studied School Class&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_laststudied'];?></td>
      </tr>

      

      <tr>
        <td class="first_td">Name of School&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_schoolname'];?></td>
      </tr>

       <tr>
        <td class="first_td">Medium&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_medium'];?></td>
      </tr>

       <tr>
        <td class="first_td">Identification Mark&nbsp;&nbsp;:&nbsp;</td>
        <!--<td class="second_td">:</td>-->
        <td class="third_td"><?php echo $admission['admission_identification'];?></td>
      </tr>
    </table>
  </div>
</div>

<hr></hr>

<form action="<?php echo site_url('entrance/home/paynow'); ?>" method="POST"> 
<table width="100%">
    <tr><td>Admission Options&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
    <td>1.<?php echo $admission['admission_institute_optionone'];?>
    <br>
    
    
    2.<?php echo $admission['admission_institute_optiontwo'];?>
    
    <br>
    3.<?php echo $admission['admission_institute_optionthree'];?>
    </td></tr>
    
    <tr><td>Entrance Exam Center&nbsp;&nbsp;:&nbsp;</td><td><?php echo $admission['admission_institute_examcenter'];?></tr>
    
   
   <tr>
       
       
       <td >
           
           
          <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['pledge'];?>" width="100%" height="180">-->
          
          
          Pledge<input type="checkbox" id="checkterms" name="checkterms" required />
          </td>
          
          <td>
          
         ഞാന്‍  സമസ്ത കേരള ജംഇയ്യത്തുല്‍ ഉലമായുടെയും അതിന്റെ കീഴ്ഘടകങ്ങളുടെയും ആശയാദര്‍ശങ്ങളില്‍ അടി യുറച്ചു വിശ്വസിക്കുന്നവനും അതനുസരിച്ചു പ്രവര്‍ത്തിക്കുന്നവനുമാണ് . മേല്‍ കാണിച്ച വിവരങ്ങള്‍ സത്യമാണെന്നും എന്റെ കുട്ടിക്ക് അഡ്മിഷന്‍ ലഭിക്കുന്ന പക്ഷം സ്ഥാപനത്തിന്റെ 12 വര്‍ഷ കോഴ്‌സ് പൂര്‍ത്തിയാകുന്നത് വരെ സ്ഥാപനത്തില്‍ തന്നെ പഠിപ്പിക്കുമെന്നും , കുട്ടിയുടെ രക്ഷിതാവ് എന്ന നിലക്ക് കുട്ടിയുടെ അടിസ്ഥാന രേഖകള്‍ (SSLC, +2, Degree Certificates) മുഴുവനും കോഴ്‌സ് പൂര്‍ത്തിയാകുന്നത് വരെ സ്ഥാപനത്തിന്റെ ഉത്തരവാധിത്വത്തില്‍ ഏല്‍പിക്കുമെന്നും , കുട്ടിയുടെ വസ്ത്ര ധാരണയടക്കമുള്ള വേഷവിധാനങ്ങള്‍ മുതലായ മുഴുവന്‍ കാര്യങ്ങളിലും സ്ഥാപനത്തിന്റെ നിയമങ്ങള്‍ മുഴുവനും ഞാനും എന്റെ മകനും അംഗീകരിച്ചു നടപ്പില്‍ വരുത്തുമെന്നും, മേല്‍ പറഞ്ഞ കാര്യങ്ങള്‍ക്ക് വിരുദ്ധം വരു ത്തുന്ന പക്ഷം സ്ഥാപനം എടുക്കുന്ന എല്ലാ തീരുമാനങ്ങളും അംഗീകരിക്കാന്‍ ഞങ്ങള്‍ ബാധ്വസ്ഥരാണെന്നും ഇതിനാല്‍ സാക്ഷ്യപ്പെടുത്തുന്നു.
          
         
   </td>
   </tr>
   </table>

<hr></hr>
 <table style="width: 100%">

<tr>
<td style="width: 50%; font-size:20px;"><b>

<button type="submit" id="submit" class="btn btn-success" onclick="proceedtonext()">Edit And Confirm</button>
</form>
</td>
</tr>
</table>


</body>
</html>
            
            
         


