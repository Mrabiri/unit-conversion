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
            <option value="cm">سانتیمتر (cm)</option>
            <option value="m">متر (m)</option>
            <option value="inch">اینچ (inch)</option>
            <option value="ft">فوت (ft)</option>
            <option value="g">گرم (g)</option>
            <option value="kg">کیلوگرم (kg)</option>
            <option value="fahrenheit">فارنهایت (Fahrenheit)</option>
            <option value="celsius">سلسیوس (Celsius)</option>
        </select>
        <label>به:</label>
        <select name="to_unit">
            <option value="cm">سانتیمتر (cm)</option>
            <option value="m">متر (m)</option>
            <option value="inch">اینچ (inch)</option>
            <option value="ft">فوت (ft)</option>
            <option value="g">گرم (g)</option>
            <option value="kg">کیلوگرم (kg)</option>
            <option value="fahrenheit">فارنهایت (Fahrenheit)</option>
            <option value="celsius">سلسیوس (Celsius)</option>
        </select>
        <input type="submit" name="convert" value="تبدیل">
    </form>

    <?php
    // تابع تبدیل واحدها
    function convert_units($value, $from_unit, $to_unit) {
        switch($from_unit) {
            case 'cm':
                $base_value = $value / 100; // تبدیل به متر
                break;
            case 'm':
                $base_value = $value; // متر
                break;
            case 'inch':
                $base_value = $value * 0.0254; // تبدیل به متر
                break;
            case 'ft':
                $base_value = $value * 0.3048; // تبدیل به متر
                break;
            case 'g':
                $base_value = $value / 1000; // تبدیل به کیلوگرم
                break;
            case 'kg':
                $base_value = $value; // کیلوگرم
                break;
            case 'fahrenheit':
                $base_value = ($value - 32) * (5/9); // تبدیل به سلسیوس
                break;
            case 'celsius':
                $base_value = $value; // سلسیوس
                break;
            default:
                $base_value = false; // واحد نامعتبر
        }

        if ($base_value === false) {
            return false;
        }

        switch($to_unit) {
            case 'cm':
                return $base_value * 100; // تبدیل به سانتیمتر
            case 'm':
                return $base_value; // متر
            case 'inch':
                return $base_value / 0.0254; // تبدیل به اینچ
            case 'ft':
                return $base_value / 0.3048; // تبدیل به فوت
            case 'g':
                return $base_value * 1000; // تبدیل به گرم
            case 'kg':
                return $base_value; // کیلوگرم
            case 'fahrenheit':
                return ($base_value * (9/5)) + 32; // تبدیل به فارنهایت
            case 'celsius':
                return $base_value; // سلسیوس
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
