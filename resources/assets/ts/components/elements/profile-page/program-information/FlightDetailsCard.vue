<script setup lang="ts">
import DetailsCard from '../../DetailsCard.vue';
import {useStudentFlightDetailsStore} from '../../../../store/studentFlightDetails';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';

const studentFlightDetailsStore = useStudentFlightDetailsStore();
const { isLoading, isSuccess, mnlDeparture, usArrival, usDeparture, mnlArrival } = storeToRefs(studentFlightDetailsStore);

onMounted(async () => {
    await studentFlightDetailsStore.loadStudentFlightDetails();
})
</script>

<template>
    <DetailsCard title="Flight Detail">
        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td colspan="2"><b>Departure from Manila</b></td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td>{{ mnlDeparture?.mnl_departure_date }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td>{{ mnlDeparture?.mnl_departure_time }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td>{{ mnlDeparture?.mnl_departure_flight_no }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td>{{ mnlDeparture?.mnl_departure_airline }}</td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td colspan="2"><b>Arrival to US</b></td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td>{{ usArrival?.us_arrival_date }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td>{{ usArrival?.us_arrival_time }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td>{{ usArrival?.us_arrival_flight_no }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td>{{ usArrival?.us_arrival_airline }}</td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td colspan="2"><b>Departure from US</b></td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td>{{ usDeparture?.us_departure_date }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td>{{ usDeparture?.us_departure_time }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td>{{ usDeparture?.us_departure_flight_no }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td>{{ usDeparture?.us_departure_airline }}</td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td colspan="2"><b>Arrival to Manila</b></td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td>{{ mnlArrival?.mnl_arrival_date }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td>{{ mnlArrival?.mnl_arrival_time }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td>{{ mnlArrival?.mnl_arrival_flight_no }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td>{{ mnlArrival?.mnl_arrival_airline }}</td>
                </tr>
            </tbody>
        </table>
    </DetailsCard>
</template>