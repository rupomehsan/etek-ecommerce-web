<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="background: rgb(36, 36, 36); color:white;">
    <div style="margin: 100px 0px; text-align: center;" id="no">

    </div>
    <script>
        si = +(localStorage.getItem('si') || 0);
        async function up_price(si) {
            try {
                await fetch('/up_price_amount?si=' + si);
                si = si + 1;
                localStorage.setItem('si', si);
                no.innerHTML = si;

                if (si > 67021) {
                    no.innerHTML = 'complete';
                    return 0;
                }
                await up_price(si);
            } catch (error) {

            }
        }

        up_price(si);
    </script>
</body>

</html>
