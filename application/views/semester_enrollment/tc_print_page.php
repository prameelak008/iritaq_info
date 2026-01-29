<!DOCTYPE html>
<html>
<head>


        <style>

        .a4-sheet {
        width: 210mm;         /* A4 width */
        min-height: 297mm;    /* A4 height */
        border: 2px solid #000;
        padding: 20px;
        box-sizing: border-box;
        background: #fff;
        }

        @page {
            size: A4;
            margin: 15mm; /* smaller margin to prevent cutting */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Outer container to keep border safe */
        .a4-wrapper {
            width: 100%;
            box-sizing: border-box;
            padding-right: 5mm;   /* key fix */
        }

        /* Actual bordered sheet */
        .a4-sheet {
            border: 2px solid #000;
            padding: 20px;
            box-sizing: border-box;
        }

        .logo {
            width: 90px;
            display: block;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 15px;
        }

        table td {
            border: 1px solid #000;
            padding: 10px 12px;
            vertical-align: top;
            width: 50%;
        }

        .signature-section {
            margin-top: 70px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="a4-wrapper">
<div class="a4-sheet">

    <img src="<?= base_url('uploads/school_logo.png') ?>" class="logo">

   
   
    <div class="title">TRANSFER CERTIFICATE</div>

    <table>


 <tr>
        <td><b>Tc.No</b></td>
        <td><?= $tc_details['tc_number'] ?></td>
    </tr>

    <tr>
        <td><b>Student Name</b></td>
        <td><?= $tc_details['firstname'] ?></td>
    </tr>

    <tr>
        <td><b>Admission No</b></td>
        <td><?= $tc_details['admission_no'] ?></td>
    </tr>


     <tr>
        <td><b>Program</b></td>
        <td><?= $tc_details['p_name'].'&nbsp;&nbsp;'.$tc_details['batch_group_year'] ?></td>
    </tr>

    <tr>
        <td><b>Reason for TC</b></td>
        <td><?= $tc_details['reason'] ?></td>
    </tr>

    <tr>
        <td><b>TC Issue Date</b></td>
        <td><?= $tc_details['issue_date'] ?></td>
    </tr>

    <tr>
        <td><b>Last Attendance</b></td>
        <td><?= $tc_details['last_attendance'] ?></td>
    </tr>

    <tr>
        <td><b>Conduct</b></td>
        <td><?= $tc_details['conduct'] ?></td>
    </tr>

    <tr>
        <td><b>Remarks</b></td>
        <td><?= $tc_details['remarks'] ?></td>
    </tr>
</table>


    <div class="signature-section">
        <div class="signature-box">Class Teacher Signature __________________</div>
        <div class="signature-box">Principal Signature ____________________</div>
    </div>

</div>
</div>

</body>
</html>
