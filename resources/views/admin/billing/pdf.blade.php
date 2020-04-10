<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$school}} - {{$date}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .invoice h4 {
            margin-left: 15px;
        }
        .invoice h5 {
            margin-left: 15px;
        }
        .information {
            background-color: #078f56;
            color: #FFF;
        }
        .information .logo {
            background-color: #fff;
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }

        .boxformula {
        background-color: #000;
        width: 100%;
/*        border: 20px solid white;*/
        padding: 10px;
        margin: 15px;
        }
        .boxes {
              vertical-align: text-top;
        border: .5px solid black;  
        padding: 10px;
        margin: 15px;
        }

        .page-break {
    page-break-after: always;
}
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">

<img src="{{public_path('img/paascu.png')}}" alt="Logo" width="64" class="logo"/>
<h3>PHILIPPINE ACCREDITING ASSOCIATION OF SCHOOLS,COLLEGES AND UNIVERSITIES (PAASCU)</h3>
                <pre>
Unit 107
The Tower at Emerald Square
J.P. Rizal Street
corner P. Tuazon Boulevard
Marilag, Quezon City,
1100 Metro Manila
<br /><br />
Billing Date: {{$date}} 
</pre>


            </td>
            <td align="center">

            </td>
            <td align="right" style="width: 40%;">

                <h3>{{$school}}</h3>

   <pre>               {{--   https://company.com<br> Street 26 123456 City United Kingdom --}}
{{$address}}
</pre>
            </td>
        </tr>

    </table>
</div>


<br/>
        @php
        $i=0;
        @endphp
<div class="invoice">
    <h3>{{$membership_type}} Membership Fee</h3>
    <h5>Transaction Reference No. #{{$id}}</h5>
    <table width="100%">
        <thead>
        <tr>
        @foreach($membershipids as $msi)
        <th style="width: 33.33%">{{$msi->variables->title}}</th>
        @php
        $i++;
        @endphp
        @endforeach
{{--             <th style="width: 33.33%">Program</th> --}}
            <th style="width: 33.33%">Gross Tuition Fee</th>
            <th style="width: 33.33%"><u>Annual Membership Fee</u></th>
        </tr>
        </thead>
        <tbody>
        <tr>
        @foreach($membertype as $ggg)

        <td style="text-align: center;">P {{number_format($ggg->content,2)}}</td>
        @endforeach
{{--             <td>Item 1</td> --}}
            <td style="text-align: center;">P {{$gtr}}</td>
            <td style="text-align: center;">P {{$amf}}</td>
        </tr>
                <tr>
{{--             <td>Item 1</td> --}}
            <td style="text-align: center;"> </td>
            <td style="text-align: center;"> </td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="{{$i}}"></td>
            <td align="center"><h2>Total Payment Due:</h2></td>
            <td align="center" class="gray"><u><h2>P {{$amf}}</h2></u></td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} PAASCU Accounting System - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                PAASCU 
            </td>
        </tr>

    </table>
</div>
<div class="page-break"></div>
{{-- THIS IS THE INFORMATION SHEET SECTION NOW !!! --}}
<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">

<img src="{{public_path('img/paascu.png')}}" alt="Logo" width="64" class="logo"/>
<h3>PHILIPPINE ACCREDITING ASSOCIATION OF SCHOOLS,COLLEGES AND UNIVERSITIES (PAASCU)</h3>



            </td>
            <td align="center">

            </td>

        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>{{$membership_type}} Annual Membership Information Sheet
S.Y. {{ date('Y')." - ".$addyear }} 
</h3>
        <br></br>
    <h3 style="display:inline;">Accredited {{$membership_type}} :</h3> <h4 style="display:inline;"><u>{{$school}}</u></h4>
            <br></br><br></br><br></br>  
    <h3 style="display:inline;">Address :</h3> <h4 style="display:inline;"><u>{{$address}}</u></h4>
    <br></br><br>
    <h3>Membership Fee Formula</h3>
    <div class="boxformula">
    <h5 style="color: #fff"><b>{{$formula}} = Gross Tuition Fee = Annual Membership Fee</b></h5>
</div>
    <table width="100%">
        <thead>
        <tr>
            @foreach($boxes as $box)
                        <th style="width: 50%;height: 50px;"  >{{$box->title}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($boxes as $box)
                        <th style="width: 50%;height: 150px;" class="boxes" ></th>
            @endforeach
        </tr>
        </tbody>
    </table>
    <br></br>
                <br></br>
    <table width="100%">
        <thead>
        <tr>
            <th style="width: 50%">____________________________________</th>
            <th style="width: 50%">____________________________________</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td style="text-align: center;">Administrator</td>
            <td style="text-align: center;">Date</td>
        </tr>

        </tbody>
            <br></br>
                    <br></br>
                            <br></br>
<h4>* Please consult Schedule of Membership Fees. Since we accredit by levels, each department
should pay its own membership fee based on its Gross tuition Revenue.</h4>

<h4>N.B. PLEASE ACCOMPLISH AND RETURN ONE (1) COPY TO PAASCU. </h4>
        <tfoot>

        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} PAASCU Accounting System - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                PAASCU 
            </td>
        </tr>

    </table>
</div>
</body>
</html>



