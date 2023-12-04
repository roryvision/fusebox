<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bubble Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
</head>
<style>
    .title {
            font-family: 'Visby';
            font-size: 42px;
            font-weight: bolder;
            margins: auto;
            text-align: center;
    }

    .graph {
            font-family: 'Visby';
            font-size: 34px;
            font-weight: bolder;
            margins: auto;
            text-align: center;
            color: #DC1F1F;

    }
    canvas {
        padding-left: 0;
        padding-right: 0;
        margin-left: auto;
        margin-right: auto;
        display: block;
        width:100%;
        max-width:1000px;
    }
</style>
<body>
<!--<div id='container'>-->
<!--    <header-nav></header-nav>-->
<!--    <ul class='flex-btwn' id='select-menu'>-->
<!--        <li class='cursor-pointer selected' value='Roles'>Roles</li>-->
<!--        <li class='cursor-pointer' value='Categories'>Categories</li>-->
<!--    </ul>-->
<div id='container'>
<header-nav></header-nav>
    <br/>
    <div class="title">
        Data Visualization
    </div>
    <br/><br/>
    <div class="graph">
        Role Frequency in Projects
    </div>
    <br/>


<?php
$host = "fseo.webdev.iyaserver.com";
$userid = "fseo";
$userpw = "AcadDev_Seo_4772155360";
$db = "fseo_fusebox";

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$data = array();

$sql1 = "SELECT role_name, COUNT(*) as totalRoles FROM projects_x_roles_x_names GROUP BY role_name";
$results1 = $mysql->query($sql1);

if ($results1->num_rows > 0) {
    while ($currentrow = $results1->fetch_assoc()) {
//        echo $currentrow['role_name'] . ":" . $currentrow['totalRoles'];
        $data[] = array(
            'role_name' => $currentrow['role_name'],
            'totalRoles' => $currentrow['totalRoles']
        );
    }
}

$data2 = array();

$sql2 = "SELECT role_type, COUNT(*) as totalTypes FROM projects_x_roles_x_names GROUP BY role_type";
$results2 = $mysql->query($sql2);

if ($results2->num_rows > 0) {
    while ($currentrow2 = $results2->fetch_assoc()) {
//        echo $currentrow2['role_type'] . ":" . $currentrow2['totalTypes'];
        $data2[] = array(
            'role_type' => $currentrow2['role_type'],
            'totalTypes' => $currentrow2['totalTypes']
        );
    }
}


?>

<script>
    var inputdata = <?php echo json_encode($data); ?>;
    console.log('PHP Data:', inputdata);
</script>

<canvas id="myChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    var customColors = ['#93D695', '#F8625A', '#FFBF4A', '#1F479B', '#8D43A7'];

    var data = {
        datasets: [
            {
                label: 'Role Frequency in Projects',
                data: [],
                backgroundColor: [],
                borderColor: [],
            },
        ],
    };



    for (var i = 0; i < inputdata.length; i++) {
        var radius = (inputdata[i].totalRoles) * 20;
        var position = generateRandomPosition(data.datasets[0].data, radius);

        var randomColorIndex = Math.floor(Math.random() * customColors.length);
        var backgroundColor = customColors[randomColorIndex];
        var borderColor = backgroundColor;

        data.datasets[0].data.push({
            x: position.x,
            y: position.y,
            r: radius,
            label: inputdata[i].role_name,

        });



        data.datasets[0].backgroundColor.push(backgroundColor);
        data.datasets[0].borderColor.push(borderColor);
    }

   // console.log(data.datasets[0])

    var options = {
        scales: {
            x: {
                display: false,

            },
            y: {
                    display: false,
            },
        },
        plugins: {
            legend: {
                display: false,
            },
            datalabels: {
                formatter: function (value, context) {
                    return context.dataset.data[context.dataIndex].label;
                },
                anchor: function (context) {
                    return context.dataset.data[context.dataIndex].r < 50 ? 'end' : 'center';
                },
                align: function (context) {
                    return context.dataset.data[context.dataIndex].r < 50 ? 'end' : 'center';
                },
                color: function (context) {
                    return context.dataset.data[context.dataIndex].r < 50 ? context.dataset.backgroundColor : 'white';
                },
                offset: 2,
                padding: 0
            },
        },
        tooltips: {
            enabled: true,
            mode: 'nearest',
            callbacks: {
                label: function (tooltipItem) {
                    if (tooltipItem.dataset && tooltipItem.dataset.data) {
                        var dataPoint = tooltipItem.dataset.data[tooltipItem.dataIndex];
                        console.log(dataPoint)
                        return `Role: ${dataPoint.label}, Radius: ${dataPoint.r}`;
                    },
                    // console.log(tooltipItem)
                    // return 'Hello'

                },
            },
        },
    };

    var canvas = document.getElementById('myChart');
    var ctx = canvas.getContext('2d');

    console.log(options.scales.x.display);

    var myChart = new Chart(ctx, {
        type: 'bubble',
        data: data,
        options: options,
    });


    function generateRandomPosition(existingPositions, radius) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var maxX = ctx.canvas.width - radius;
        var maxY = 700 - radius;

        var x = Math.random() * maxX;
        var y = Math.random() * maxY;

        for (var i = 0; i < existingPositions.length; i++) {
            var distance = Math.sqrt(Math.pow(x - existingPositions[i].x, 2) + Math.pow(y - existingPositions[i].y, 2));
            if (distance < radius * 2) {
                return generateRandomPosition(existingPositions, radius);
            }
        }

        return { x: x, y: y };
    }


</script>
<br/><br/>
    <div class="graph">
        Role Category Frequency
    </div>
    <br/>
<script>
    var inputdata = <?php echo json_encode($data2); ?>;
    console.log('PHP Data:', inputdata);
</script>

<canvas id="myChart2" style="width:100%;max-width:1000px"></canvas>

<script>
    var customColors = ['#93D695', '#F8625A', '#FFBF4A', '#1F479B', '#8D43A7'];

    var data = {
        datasets: [
            {
                label: 'Role Type Frequency in Projects',
                data: [],
                backgroundColor: [],
                borderColor: [],
            },
        ],
    };



    for (var i = 0; i < inputdata.length; i++) {
        var radius = (inputdata[i].totalTypes) * 5;
        var position = generateRandomPosition(data.datasets[0].data, radius);

        var randomColorIndex = Math.floor(Math.random() * customColors.length);
        var backgroundColor = customColors[randomColorIndex];
        var borderColor = backgroundColor;

        data.datasets[0].data.push({
            x: position.x,
            y: position.y,
            r: radius,
            label: inputdata[i].role_type,
        });

        data.datasets[0].backgroundColor.push(backgroundColor);
        data.datasets[0].borderColor.push(borderColor);
    }

    var options = {
        scales: {
            x: {
                display: false,
            },
            y: {
                display: false,
            },
        },
        plugins: {
            legend: {
                display: false,
                position: 'top',
            },

            datalabels: {
                anchor: function (context) {
                    console.log(context.dataIndex)
                    var value = context.dataset.data[context.dataIndex];
                    return value.y < 50 ? 'end' : 'center';

                },

                align: function (context) {
                    var value = context.dataset.data[context.dataIndex];
                    return value.y < 50 ? 'end' : 'center';
                },
                color: function (context) {
                    var value = context.dataset.data[context.dataIndex];
                    return value.y < 50 ? context.dataset.backgroundColor : 'white';
                },

                formatter: function (value) {
                    return Math.round(value.y);
                },
                offset: 2,
                padding: 0

            },
        },
    };

    var canvas = document.getElementById('myChart2');
    var ctx = canvas.getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bubble',
        data: data,
        options: options,
    });

    function generateRandomPosition(existingPositions, radius) {
        var ctx = document.getElementById('myChart2').getContext('2d');
        var maxX = ctx.canvas.width - radius;
        var maxY = 700 - radius;

        var x = Math.random() * maxX;
        var y = Math.random() * maxY;

        for (var i = 0; i < existingPositions.length; i++) {
            var distance = Math.sqrt(Math.pow(x - existingPositions[i].x, 2) + Math.pow(y - existingPositions[i].y, 2));
            if (distance < radius * 2) {
                return generateRandomPosition(existingPositions, radius);
            }
        }

        return { x: x, y: y };
    }
</script>
</div>
</body>
</html>
