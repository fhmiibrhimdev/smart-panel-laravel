<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Solar Panel</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/assets/stisla/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/all.css" />
    <link rel="stylesheet" href="https://static.fontawesome.com/css/fontawesome-app.css" />
    <link rel="stylesheet" href="{{ asset('assets/midragon/css/custom.css') }}">
    <link rel="icon" href="{{ asset('/assets/MIDRAGON.png') }}">

    @stack('general-css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/stisla/css/components.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Iceberg&display=swap');

    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body onload="startConnect()"
    class="tw-bg-gray-900 tw-text-white tw-w-full tw-min-h-screen tw-bg-no-repeat tw-bg-cover tw-bg-fixed tw-bg-center"
    style="background-image: url('assets/images/background.png'); font-family: 'Chakra Petch', sans-serif;">
    {{ $slot }}

    <!-- General JS Scripts -->
    <script src="{{ asset('/assets/midragon/select2/jquery.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/stisla/js/bootstrap.min.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/midragon/js/sweetalert2@11.js') }}"></script>
    @stack('js-libraries')

    <!-- Page Specific JS File -->
    <script src="{{ asset('/assets/stisla/js/stisla.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js" type="text/javascript">
    </script>
    <script>
        function openCity(evt, cityName) {
            let i, content, tablinks;
            content = document.getElementsByClassName("content");
            for (i = 0; i < content.length; i++) {
                content[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }


        function startConnect() {
            clientID = "client_ind" + parseInt(Math.random() * 100);
            host = "103.197.190.125";
            port = "9001";
            client = new Paho.MQTT.Client(host, Number(port), clientID);
            client.onConnectionLost = onConnectionLost;
            client.onMessageArrived = onMessageArrived;

            client.connect({
                onSuccess: onConnect,
                userName: 'nexaryn',
                password: '31750321'
            });

        }

        function onConnect() {
            client.subscribe("solar-panel/pnj/micro_1/data");
            client.subscribe("solar-panel/pnj/micro_2/data");
            console.log("berhasil konek");
            $("#status-iot").html('<span class="tw-text-green-300">Connected!</span>');
        }

        function onConnectionLost(responseObject) {
            $("#status-iot").html('<span class="tw-text-red-300">Disconnected!</span>');
            if (responseObject.errorCode !== 0) {
                document.getElementById("messages").innerHTML = '<span>ERROR: ' + +responseObject.errorMessage +
                    '</span><br/>';
            }
        }

        function onMessageArrived(message) {
            // console.log("onMessageArrived: " + message.payloadString);
            // console.log("topic: " + message.destinationName);
            // document.getElementById("messages").innerHTML = '<span>Topic: ' + message.destinationName + '  | ' + message.payloadString + '</span><br/>';

            if (message.destinationName == "solar-panel/pnj/micro_1/data") {
                let data = JSON.parse(message.payloadString);
                // Temperature
                $('#temp_a').html(data.temp.a);
                $('#temp_bc').html(data.temp.bc);
                $('#temp_bh').html(data.temp.bh);
                $('#temp_c').html(data.temp.c);
                $('#temp_dh').html(data.temp.dh);
                $('#temp_dc').html(data.temp.dc);
                $('#temp_fc').html(data.temp.fc);
                $('#temp_fh').html(data.temp.fh);
                $('#temp_g').html(data.temp.g);
                $('#temp_hh').html(data.temp.hh);
                $('#temp_hc').html(data.temp.hc);
                $('#temp_i').html(data.temp.i);
            }
        }

        function startDisconnect() {
            client.disconnect();
            document.getElementById("messages").innerHTML = '<span>Disconnected</span><br/>';
        }

    </script>
    <script>
        const ctxTemperature = document.getElementById('graph-temperature');
        const ctxVoltage = document.getElementById('graph-voltage');
        const ctxCurrent = document.getElementById('graph-current');

        new Chart(ctxTemperature, {
            type: 'line',
            data: {
                labels: ['10:00:01', '10:00:02', '10:00:03', '10:00:04', '10:00:05', '10:00:06'],
                datasets: [{
                    label: 'Last Day',
                    data: [0.0, 10.2, 20.3, 22.1, 23.4, 23.6],
                    borderColor: '#00e5ff', // Electric cyan
                    backgroundColor: 'rgba(0, 229, 255, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0,
                    pointBackgroundColor: '#00e5ff',
                    pointBorderColor: '#00e5ff',
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 8
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' °C';
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(248, 250, 252, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(248, 250, 252, 0.7)',
                            callback: function (value) {
                                return value + ' °C';
                            }
                        },
                    },
                    x: {
                        grid: {
                            color: 'rgba(248, 250, 252, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(248, 250, 252, 0.7)'
                        },
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                hover: {
                    animationDuration: 300
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
        new Chart(ctxVoltage, {
            type: 'line',
            data: {
                labels: ['10:00:01', '10:00:02', '10:00:03', '10:00:04', '10:00:05', '10:00:06'],
                datasets: [{
                    label: 'Last Day',
                    data: [0.0, 10.2, 20.3, 22.1, 23.4, 23.6],
                    borderColor: '#ff9500',
                    backgroundColor: 'rgba(255, 149, 0, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0,
                    pointBackgroundColor: '#ff9500',
                    pointBorderColor: '#ff9500',
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 8
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' V';
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(248, 250, 252, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(248, 250, 252, 0.7)',
                            callback: function (value) {
                                return value + ' V';
                            }
                        },
                    },
                    x: {
                        grid: {
                            color: 'rgba(248, 250, 252, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(248, 250, 252, 0.7)'
                        },
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                hover: {
                    animationDuration: 300
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
        new Chart(ctxCurrent, {
            type: 'line',
            data: {
                labels: ['10:00:01', '10:00:02', '10:00:03', '10:00:04', '10:00:05', '10:00:06'],
                datasets: [{
                    label: 'Last Day',
                    data: [0.0, 10.2, 20.3, 22.1, 23.4, 23.6],
                    borderColor: '#ff1744', // Electric red
                    backgroundColor: 'rgba(255, 23, 68, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0,
                    pointBackgroundColor: '#ff1744',
                    pointBorderColor: '#ff1744',
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 8
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' A';
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(248, 250, 252, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(248, 250, 252, 0.7)',
                            callback: function (value) {
                                return value + ' A';
                            }
                        },
                    },
                    x: {
                        grid: {
                            color: 'rgba(248, 250, 252, 0.1)',
                            lineWidth: 1
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(248, 250, 252, 0.7)'
                        },
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                hover: {
                    animationDuration: 300
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });

    </script>
</body>

</html>
