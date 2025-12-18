import http from 'k6/http';
import { sleep, check } from 'k6';

export const options = {
    vus: 10,
    duration: '10s'
};

export default function () {
    let res = http.get('http://127.0.0.1:8000');

    check(res, {
        'status 200': (r) => r.status === 200,
    });

    sleep(1);
}
