<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useCoordStudentFlightInfo } from '../../../../store/coordStudentFlightInfo';
import { storeToRefs } from 'pinia';
import AlertService from '../../../../services/AlertService';

const coordStudentFlightInfoStore = useCoordStudentFlightInfo();
const { isLoading, mnlDeparture, usArrival, usDeparture, mnlArrival } = storeToRefs(coordStudentFlightInfoStore);

const deptFromMnlIsEdit = ref<boolean>(false);
const arrFromMnlIsEdit = ref<boolean>(false);
const deptFromUsIsEdit = ref<boolean>(false);
const arrFromUsIsEdit = ref<boolean>(false);
const deptFromMnlForm = ref();
const arrToUsForm = ref();
const deptFromUsForm = ref();
const arrToMnlForm = ref();

onMounted(async () => {
    const res = await coordStudentFlightInfoStore.loadSelectedStudentFlightInfo();
    if (!res.success) await AlertService.error(res.message || 'Failed to load flight info');

    deptFromMnlForm.value = {...mnlDeparture.value};
    arrToUsForm.value = {...usArrival.value};
    deptFromUsForm.value = {...usDeparture.value};
    arrToMnlForm.value = {...mnlArrival.value};
})

const updateDepartureFromManilaInfo = async (flightType : string) => {
    let data = {} as any;

    switch (flightType) {
        case 'depart-mnl':
            data = {...deptFromMnlForm.value};
            deptFromMnlIsEdit.value = false;
        break;

        case 'arrive-us':
            data = {...arrToUsForm.value};
            arrFromUsIsEdit.value = false;
        break;

        case 'depart-us':
            data = {...deptFromUsForm.value};
            deptFromUsIsEdit.value = false;
        break;

        case 'arrive-mnl':
            data = {...arrToMnlForm.value};
            arrFromMnlIsEdit.value = false;
        break;
    }

    const res = await coordStudentFlightInfoStore.updateSelectedStudentFlightInfo({data: data});
    if (res.success) {
        await AlertService.success('Flight details updated', 'Success');
    } else if (res.errors) {
        await AlertService.validation(res.errors);
    } else {
        await AlertService.error(res.message || 'Failed to update flight details');
    }
}

</script>

<template>
    <section id="flight-details">
        <div class="ml-2 mt-2 mr-2" style="display: flex; justify-content:space-between;">
            <label class="control-label">PDOS & CFO details</label>
        </div>
        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td><b>Departure from Manila</b></td>
                    <td style="padding-right: 8px;">
                        <div style=" display: flex; justify-content:flex-end;">
                            <a v-if="!deptFromMnlIsEdit" @click.prevent="deptFromMnlIsEdit = true" href="#">Edit</a>
                            <div v-if="deptFromMnlIsEdit">
                                <a @click.prevent="updateDepartureFromManilaInfo('depart-mnl')" href="#" class="mr-1">Update</a>
                                <a @click.prevent="deptFromMnlIsEdit = false" href="#">Cancel</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td v-if="!deptFromMnlIsEdit">{{ mnlDeparture.mnl_departure_date }}</td>
                    <td v-if="deptFromMnlIsEdit">
                        <input v-model="deptFromMnlForm.mnl_departure_date" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td v-if="!deptFromMnlIsEdit">{{ mnlDeparture.mnl_departure_time }}</td>
                    <td v-if="deptFromMnlIsEdit">
                        <input v-model="deptFromMnlForm.mnl_departure_time" type="time" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td v-if="!deptFromMnlIsEdit">{{ mnlDeparture.mnl_departure_flight_no }}</td>
                    <td v-if="deptFromMnlIsEdit">
                        <input v-model="deptFromMnlForm.mnl_departure_flight_no" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td v-if="!deptFromMnlIsEdit">{{ mnlDeparture.mnl_departure_airline }}</td>
                    <td v-if="deptFromMnlIsEdit">
                        <input v-model="deptFromMnlForm.mnl_departure_airline" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td><b>Arrival to US</b></td>
                    <td style="padding-right: 8px;">
                        <div style=" display: flex; justify-content:flex-end;">
                            <a v-if="!arrFromUsIsEdit" @click.prevent="arrFromUsIsEdit = true" href="#">Edit</a>
                            <div v-if="arrFromUsIsEdit">
                                <a @click.prevent="updateDepartureFromManilaInfo('arrive-us')" href="#" class="mr-1">Update</a>
                                <a @click.prevent="arrFromUsIsEdit = false" href="#">Cancel</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td v-if="!arrFromUsIsEdit">{{ usArrival.us_arrival_date }}</td>
                    <td v-if="arrFromUsIsEdit">
                        <input v-model="arrToUsForm.us_arrival_date" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td v-if="!arrFromUsIsEdit">{{ usArrival.us_arrival_time }}</td>
                    <td v-if="arrFromUsIsEdit">
                        <input v-model="arrToUsForm.us_arrival_time" type="time" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td v-if="!arrFromUsIsEdit">{{ usArrival.us_arrival_flight_no }}</td>
                    <td v-if="arrFromUsIsEdit">
                        <input v-model="arrToUsForm.us_arrival_flight_no" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td v-if="!arrFromUsIsEdit">{{ usArrival.us_arrival_airline }}</td>
                    <td v-if="arrFromUsIsEdit">
                        <input v-model="arrToUsForm.us_arrival_airline" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td><b>Departure from US</b></td>
                    <td style="padding-right: 8px;">
                        <div style=" display: flex; justify-content:flex-end;">
                            <a v-if="!deptFromUsIsEdit" @click.prevent="deptFromUsIsEdit = true" href="#">Edit</a>
                            <div v-if="deptFromUsIsEdit">
                                <a @click.prevent="updateDepartureFromManilaInfo('depart-us')" href="#" class="mr-1">Update</a>
                                <a @click.prevent="deptFromUsIsEdit = false" href="#">Cancel</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td v-if="!deptFromUsIsEdit">{{ usDeparture.us_departure_date }}</td>
                    <td v-if="deptFromUsIsEdit">
                        <input v-model="deptFromUsForm.us_departure_date" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td v-if="!deptFromUsIsEdit">{{ usDeparture.us_departure_time }}</td>
                    <td v-if="deptFromUsIsEdit">
                        <input v-model="deptFromUsForm.us_departure_time" type="time" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td v-if="!deptFromUsIsEdit">{{ usDeparture.us_departure_flight_no }}</td>
                    <td v-if="deptFromUsIsEdit">
                        <input v-model="deptFromUsForm.us_departure_flight_no" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td v-if="!deptFromUsIsEdit">{{ usDeparture.us_departure_airline }}</td>
                    <td v-if="deptFromUsIsEdit">
                        <input v-model="deptFromUsForm.us_departure_airline" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-bottom: 20px;" class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td><b>Arrival to Manila</b></td>
                    <td style="padding-right: 8px;">
                        <div style=" display: flex; justify-content:flex-end;">
                            <a v-if="!arrFromMnlIsEdit" @click.prevent="arrFromMnlIsEdit = true" href="#">Edit</a>
                            <div v-if="arrFromMnlIsEdit">
                                <a @click.prevent="updateDepartureFromManilaInfo('arrive-mnl')" href="#" class="mr-1">Update</a>
                                <a @click.prevent="arrFromMnlIsEdit = false" href="#">Cancel</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Date</td>
                    <td v-if="!arrFromMnlIsEdit">{{ mnlArrival.mnl_arrival_date }}</td>
                    <td v-if="arrFromMnlIsEdit">
                        <input v-model="arrToMnlForm.mnl_arrival_date" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Time</td>
                    <td v-if="!arrFromMnlIsEdit">{{ mnlArrival.mnl_arrival_time }}</td>
                    <td v-if="arrFromMnlIsEdit">
                        <input v-model="arrToMnlForm.mnl_arrival_time" type="time" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Flight No.</td>
                    <td v-if="!arrFromMnlIsEdit">{{ mnlArrival.mnl_arrival_flight_no }}</td>
                    <td v-if="arrFromMnlIsEdit">
                        <input v-model="arrToMnlForm.mnl_arrival_flight_no" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Airline</td>
                    <td v-if="!arrFromMnlIsEdit">{{ mnlArrival.mnl_arrival_airline }}</td>
                    <td v-if="arrFromMnlIsEdit">
                        <input v-model="arrToMnlForm.mnl_arrival_airline" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>