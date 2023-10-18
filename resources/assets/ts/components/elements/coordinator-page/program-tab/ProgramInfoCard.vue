<script setup lang="ts">
import HostCompanyDetails from './HostCompanyCard.vue';
import VisaInterviewDetails from './VisaInterviewDetails.vue';

import { ref } from 'vue';

const visaInterview = ref();
const schedule = ref();
const flightDetails = ref();

</script>

<template>
    <div class="card card-default">
        <div class="card-body p-0">
            <HostCompanyDetails />
            <VisaInterviewDetails />

            <section id="pdos-cfo-details">
                <div class="ml-2 mt-2">
                    <label class="control-label">PDOS & CFO details</label>
                </div>
                <table class="table table-striped table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">PDOS Schedule</td>
                            <td>{{ schedule?.pdos_schedule }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">PDOS Time</td>
                            <td>{{ schedule?.pdos_schedule_time }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">CFO Schedule</td>
                            <td>{{ schedule?.cfo_schedule }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">CFO Time</td>
                            <td>{{ schedule?.cfo_schedule_time }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="flight-details">
                <div class="ml-2 mt-2">
                    <label class="control-label">Flight details</label>
                </div>
                <table style="margin-bottom: 20px;" class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Departure from Manila</b></td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Date</td>
                            <td>{{ flightDetails?.mnl_departure_date }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>{{ flightDetails?.mnl_departure_time }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>{{ flightDetails?.mnl_departure_flight_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>{{ flightDetails?.mnl_departure_airline }}</td>
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
                            <td>{{ flightDetails?.us_arrival_date }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>{{ flightDetails?.us_arrival_time }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>{{ flightDetails?.us_arrival_flight_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>{{ flightDetails?.us_arrival_airline }}</td>
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
                            <td>{{ flightDetails?.us_departure_date }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>{{ flightDetails?.us_departure_time }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>{{ flightDetails?.us_departure_flight_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>{{ flightDetails?.us_departure_airline }}</td>
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
                            <td>{{ flightDetails?.mnl_arrival_date }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>{{ flightDetails?.mnl_arrival_time }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>{{ flightDetails?.mnl_arrival_flight_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>{{ flightDetails?.mnl_arrival_airline }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</template>