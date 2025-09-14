import mqtt from 'mqtt';
import axios from 'axios';

const MQTT_HOST = 'mqtt://103.197.190.125:1883';
const MQTT_USERNAME = 'nexaryn';
const MQTT_PASSWORD = '31750321';

const BASE_URL = process.env.LARAVEL_API_URL || 'http://smart-panel.test';

const client = mqtt.connect(MQTT_HOST, {
    username: MQTT_USERNAME,
    password: MQTT_PASSWORD
});

client.on('connect', () => {
    console.log('Terhubung ke MQTT broker');
    client.subscribe('solar-panel/pnj/micro_1/data');
    // client.subscribe('solar-panel/pnj/micro_1/voltage');
    // client.subscribe('solar-panel/pnj/micro_1/current');
    client.subscribe('solar-panel/pnj/micro_2/data');
});

client.on('message', async (topic, message) => {
    try {
        const payload = JSON.parse(message.toString());
        // console.log(`Pesan diterima di topik ${topic}:`, payload);
        if (topic.includes('micro_1/data')) {
            await axios.get(`${BASE_URL}/api/solar-panel/micro-1/data`, {
                params: payload
            });
            console.log('Terkirim ke micro-1 data:', payload);
        }

        // if (topic.includes('micro_1/voltage')) {
        //     await axios.get(`${BASE_URL}/api/solar-panel/micro-1/voltage`, {
        //         params: payload
        //     });
        //     console.log('Terkirim ke micro-1 voltage:', payload);
        // } 

        // if (topic.includes('micro_1/current')) {
        //     await axios.get(`${BASE_URL}/api/solar-panel/micro-1/current`, {
        //         params: payload
        //     });
        //     console.log('Terkirim ke micro-1 current:', payload);
        // } 

        if (topic.includes('micro_2/data')) {
            await axios.get(`${BASE_URL}/api/solar-panel/micro-2/irradiance`, {
                params: payload
            });
            console.log('Terkirim ke micro-2 irradiance:', payload);
        }
        // if (topic.includes('micro_1')) {
        //     await axios.get(`${BASE_URL}/api/solar-panel/micro-1`, {
        //         params: payload
        //     });
        //     console.log('Terkirim ke micro-1:', payload);
        // } else if (topic.includes('micro_2')) {
        //     await axios.get(`${BASE_URL}/api/solar-panel/micro-2`, {
        //         params: payload
        //     });
        //     console.log('Terkirim ke micro-2:', payload);
        // }
    } catch (error) {
        console.error('Gagal parsing atau mengirim data:', error.message);
    }
});
