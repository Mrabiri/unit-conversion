<!DOCTYPE html>
<html>
<head>
    <title>تبدیل واحدها با PHP</title>
</head>
<body dir=rtl>
    <h2>تبدیل واحدها با PHP</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>مقدار:</label>
        <input type="text" name="value" required>
        <select name="from_unit">
            <!-- انتخاب واحد مبدا -->
            <optgroup label="طول">
                <option value="foot">فوت (foot)</option>
                <option value="inch">اینچ (inch)</option>
                <option value="cm">سانتیمتر (cm)</option>
            </optgroup>
            <optgroup label="سرعت">
                <option value="kmh">کیلومتر در ساعت (km/h)</option>
                <option value="mph">مایل در ساعت (mph)</option>
                <option value="yard">یارد بر ثانیه (yard/s)</option>
            </optgroup>
            <optgroup label="دما">
                <option value="celsius">سلسیوس (Celsius)</option>
                <option value="fahrenheit">فارنهایت (Fahrenheit)</option>
            </optgroup>
            <optgroup label="حجم">
                <option value="liter">لیتر (liter)</option>
                <option value="gallon">گالن (gallon)</option>
            </optgroup>
            <optgroup label="وزن">
                <option value="kg">کیلوگرم (kg)</option>
                <option value="pound">پوند (pound)</option>
            </optgroup>
        </select>
        <label>به:</label>
        <select name="to_unit">
            <!-- انتخاب واحد مقصد -->
            <optgroup label="طول">
                <option value="foot">فوت (foot)</option>
                <option value="inch">اینچ (inch)</option>
                <option value="cm">سانتیمتر (cm)</option>
            </optgroup>
            <optgroup label="سرعت">
                <option value="kmh">کیلومتر در ساعت (km/h)</option>
                <option value="mph">مایل در ساعت (mph)</option>
                <option value="yard">یارد بر ثانیه (yard/s)</option>
            </optgroup>
            <optgroup label="دما">
                <option value="celsius">سلسیوس (Celsius)</option>
                <option value="fahrenheit">فارنهایت (Fahrenheit)</option>
            </optgroup>
            <optgroup label="حجم">
                <option value="liter">لیتر (liter)</option>
                <option value="gallon">گالن (gallon)</option>
            </optgroup>
            <optgroup label="وزن">
                <option value="kg">کیلوگرم (kg)</option>
                <option value="pound">پوند (pound)</option>
            </optgroup>
        </select>
        <input type="submit" name="convert" value="تبدیل">
    </form>

    <?php
    // تابع تبدیل واحدها
    function convert_units($value, $from_unit, $to_unit) {
        switch($from_unit) {
            case 'foot':
                $base_value = $value * 30.48; // تبدیل به سانتیمتر
                break;
            case 'inch':
                $base_value = $value * 2.54; // تبدیل به سانتیمتر
                break;
            case 'cm':
                $base_value = $value; // سانتیمتر
                break;
            case 'kmh':
                $base_value = $value * 0.277778; // تبدیل به متر بر ثانیه
                break;
            case 'mph':
                $base_value = $value * 0.44704; // تبدیل به متر بر ثانیه
                break;
            case 'yard':
                $base_value = $value * 0.9144; // تبدیل به متر
                break;
            case 'celsius':
                $base_value = $value; // سلسیوس
                break;
            case 'fahrenheit':
                $base_value = ($value - 32) * (5/9); // تبدیل به سلسیوس
                break;
            case 'liter':
                $base_value = $value; // لیتر
                break;
            case 'gallon':
                $base_value = $value * 3.78541; // تبدیل به لیتر
                break;
            case 'kg':
                $base_value = $value; // کیلوگرم
                break;
            case 'pound':
                $base_value = $value * 0.453592; // تبدیل به کیلوگرم
                break;
            default:
                $base_value = false; // واحد نامعتبر
        }

        if ($base_value === false) {
            return false;
        }

        switch($to_unit) {
            case 'foot':
                return $base_value / 30.48; // تبدیل به فوت
            case 'inch':
                return $base_value / 2.54; // تبدیل به اینچ
            case 'cm':
                return $base_value; // سانتیمتر
            case 'kmh':
                return $base_value / 0.277778; // تبدیل به کیلومتر در ساعت
            case 'mph':
                return $base_value / 0.44704; // تبدیل به مایل در ساعت
            case 'yard':
                return $base_value / 0.9144; // تبدیل به یارد
            case 'celsius':
                return $base_value; // سلسیوس
            case 'fahrenheit':
                return ($base_value * (9/5)) + 32; // تبدیل به فارنهایت
            case 'liter':
                return $base_value; // لیتر
            case 'gallon':
                return $base_value / 3.78541; // تبدیل به گالن
            case 'kg':
                return $base_value; // کیلوگرم
            case 'pound':
                return $base_value / 0.453592; // تبدیل به پوند
            default:
                return false; // واحد نامعتبر
        }
    }

    // بررسی فرم و تبدیل واحدها
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convert'])) {
        $value = floatval($_POST['value']);
        $from_unit = $_POST['from_unit'];
        $to_unit = $_POST['to_unit'];

        $converted_value = convert_units($value, $from_unit, $to_unit);

        if ($converted_value === false) {
            echo "<p style='color: red;'>خطا! واحد وارد شده نامعتبر است.</p>";
        } else {
            echo "<p>مقدار تبدیل شده: " . $converted_value . " " . $to_unit . "</p>";
        }
    }
    ?>
</body>
</html>
