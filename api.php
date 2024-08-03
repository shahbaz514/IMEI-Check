<title>SICKW.COM APi CHECKER</title>
<body style="background-color:white">
<center>
    <form method="POST" action="" style="margin-top:5%">
        <p><input type="text" style="padding: 15px 10px 10px; font-family: 'Source Sans Pro',arial,sans-serif; border: 1px solid #cecece; color: black;box-sizing: border-box; width: 50%; max-width: 500px;" name="imei" autocomplete="off" maxlength="50" placeholder="Write here IMEI or SN"></p>
        <select name="service" id="service" style="padding: 15px 10px 10px; font-family: 'Source Sans Pro',arial,sans-serif; border: 1px solid #cecece; color: black;box-sizing: border-box; width: 50%; max-width: 500px;">
            <option value="0" selected="selected">PLEASE CHOOSE CHECKER</option>
            <optgroup label="iPHONE SERVICES">
                <option value="105">1.10 - APPLE SOLD BY & COVERAGE &#x26A1;</option>
                <option value="103">0.05 - iPHONE CARRIER &#x26A1;</option>
                <option value="102">0.12 - iPHONE CARRIER S1 &#x26A1;</option>
                <option value="101">0.12 - iPHONE CARRIER S2 &#x26A1;</option>
                <option value="38">0.09 - iPHONE CARRIER S3 &#x26A1;</option>
                <option value="8">0.05 - iPHONE SIM-LOCK &#x26A1;</option>
                <option value="12">0.05 - IMEI &#x21C4; SN CONVERT &#x26A1;</option>
                <option value="201">0.15 - UDID &#x2192; SN CONVERT &#x26A1;</option>
                <option value="30">0.06 - APPLE BASIC INFO &#x26A1;</option>
                <option value="26">0.01 - APPLE SERIAL INFO &#x26A1;</option>
                <option value="109">0.05 - APPLE iCLOUD HINT &#x26A1;</option>
                <option value="3">0.02 - iCLOUD ON/OFF &#x26A1;</option>
                <option value="4">0.06 - iCLOUD CLEAN/LOST &#x26A1;</option>
                <option value="10">0.03 - APPLE ACTIVATION STATUS &#x26A1;</option>
                <option value="110">2.70 - MACBOOK/iMAC INFO & ICLOUD STATUS &#x26A1;</option>
                <option value="49">2.40 - APPLE iOS & MAC MDM STATUS &#x26A1;</option>
                <option value="11">3.40 - APPLE iOS & MAC MDM STATUS &#x1F552;</option>
                <option value="40">3.50 - APPLE iOS & MAC MDM & iCLOUD STATUS &#x26A1;</option>
            </optgroup>
            <optgroup label="STATUS SERVICES">
                <option value="48">1.10 - CHECKMEND BLACKLIST STATUS - PRO &#x26A1;</option>
                <option value="6">0.09 - GSMA WW BLACKLIST STATUS - PRO &#x26A1;</option>
                <option value="21">0.05 - SPRINT USA STATUS - PRO &#x26A1;</option>
                <option value="16">0.06 - T-MOBILE USA STATUS - PRO &#x26A1;</option>
                <option value="25">0.16 - T-MOBILE USA GENERIC SIMLOCK &#x26A1;</option>
                <option value="9">0.02 - VERIZON USA CLEAN/STOLEN &#x26A1;</option>
                <option value="20">0.00 - KOREA CLEAN/STOLEN &#x26A1;</option>
                <option value="31">0.00 - AUSTRALIA CLEAN/STOLEN &#x26A1;</option>
                <option value="28">0.00 - KDDI JAPAN CLEAN/STOLEN &#x26A1;</option>
                <option value="32">0.00 - SOFTBANK JAPAN CLEAN/STOLEN &#x26A1;</option>
            </optgroup>
            <optgroup label="GENERIC SERVICES">
                <option value="19">0.05 - LG INFO &#x26A1;</option>
                <option value="24">0.02 - ZTE INFO &#x26A1;</option>
                <option value="5">0.02 - SONY INFO &#x26A1;</option>
                <option value="23">0.05 - ACER INFO &#x26A1;</option>
                <option value="34">0.05 - ASUS INFO &#x26A1;</option>
                <option value="39">0.05 - OPPO INFO &#x26A1;</option>
                <option value="45">0.04 - ITEL INFO &#x26A1;</option>
                <option value="2">0.10 - NOKIA INFO &#x26A1;</option>
                <option value="44">0.04 - SONIM INFO &#x26A1;</option>
                <option value="45">0.04 - TECNO INFO &#x26A1;</option>
                <option value="15">0.08 - HUAWEI INFO &#x26A1;</option>
                <option value="22">0.05 - LENOVO INFO &#x26A1;</option>
                <option value="1">0.10 - SAMSUNG INFO &#x26A1;</option>
                <option value="17">0.05 - ALCATEL INFO &#x26A1;</option>
                <option value="36">0.05 - ONEPLUS INFO &#x26A1;</option>
                <option value="43">0.04 - KYOCERA INFO &#x26A1;</option>
                <option value="45">0.04 - INFINIX INFO &#x26A1;</option>
                <option value="13">0.05 - MOTOROLA INFO &#x26A1;</option>
                <option value="14">0.06 - BLACKBERRY INFO &#x26A1;</option>
                <option value="42">0.18 - GOOGLE PIXEL INFO &#x26A1;</option>
                <option value="203">0.01 - BRAND & MODEL INFO &#x26A1;</option>
                <option value="46">0.40 - SONY BOOTLOADER KEY &#x26A1;</option>
                <option value="37">0.00 - SIM ICCID/IMSI INFO &#x26A1;</option>
                <option value="206">0.01 - XIAOMI MI LOCK STATUS &#x26A1;</option>
            </optgroup>
            <optgroup label="PREMIUM SERVICES">
                <option value="117">15.0 - HUAWEI FRP ERASE KEY - IMEI &#x1F552;</option>
                <option value="200">1.50 - GSMA BLACKLISTING - REPORT STOLEN &#x26A1;</option>
            </optgroup>
        </select>
        <br /><br />
        <button onClick="this.form.submit(); this.disabled=true; this.value='Please Wait'; " type="submit" style="background-color: #2ABCA7; padding: 12px 45px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px; border: 1px solid #2ABCA7;-webkit-transition: .5s; transition: .5s; display: inline-block; cursor: pointer; width: 20%; max-width: 200px; color: #fff;">Submit</button>
    </form>

    <?php
    //For Debug purpose. Uncomment the next 3 lines.
    //ini_set('display_errors', '1');
    //ini_set('display_startup_errors', '1');
    //error_reporting(E_ALL);

    $format = "html"; // Display result in JSON or HTML format
    $imei = $_POST['imei']; // IMEI or SERIAL Number
    if(!filter_var($imei, FILTER_VALIDATE_EMAIL)){$imei = preg_replace("/[^a-zA-Z0-9]+/", "", $imei);} // Remove unwanted characters for IMEI/SN
    $service = $_POST['service']; // Service ID
    if($service != 'demo'){$service = preg_replace("/[^0-9]+/", "", $service);} // Remove unwanted characters for Service ID
    $api = "MNN-QUZ-60W-KI5-7PD-Z8P-C93-F9N"; // Sickw.com APi Key

    if(isset($_POST['service']) && isset($_POST['imei'])){
        if(strlen($api) !== 31){echo "<font color=\"red\"><b>API KEY is Wrong! Please set APi KEY!</b></font>"; die;}
        if(strlen($service) > 4 || $service > 250){echo "<font color=\"red\"><b>Service ID is Wrong!</b></font>"; die;}
        if(!filter_var($imei, FILTER_VALIDATE_EMAIL)){
            if(strlen($imei) < "11" || strlen($imei) > "15"){echo "<font color=\"red\"><b>IMEI or SN is Wrong!</b></font>"; die;}}

        $curl = curl_init ("https://sickw.com/api.php?format=$format&key=$api&imei=$imei&service=$service");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($curl);
        curl_close($curl);

        echo PHP_EOL."<br/><br/>".PHP_EOL.$result; // Here the result is printed
    }
    ?>
</center>
</body>