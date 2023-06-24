<script setup lang="ts">

</script>

<template>
    <div class="profile-content-body">
        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Host Company</h5>
                    <div class="profile-header__actions">
                        
                    </div>
                </div>
                
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">Visa Sponsor</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Host Company</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Housing Address</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Position</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Stipend</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Start Date</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">End Date</td>
                            <td>Test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Visa Interview Details</h5>
                    <div class="profile-header__actions">
                        
                    </div>
                </div>
                
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">Program ID Number</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">SEVIS ID</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Interview Schedule</td>
                            <td>Test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">PDOS & CFO Schedule</h5>
                    <div class="profile-header__actions">
                        
                    </div>
                </div>
                
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">PDOS Schedule</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">CFO Schedule</td>
                            <td>Test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Flight Details</h5>
                    <div class="profile-header__actions">
                        
                    </div>
                </div>
                
                <table style="margin-bottom: 20px;" class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Departure from Manila</b></td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Date</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>Test</td>
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
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>Test</td>
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
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>Test</td>
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
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Time</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Flight No.</td>
                            <td>Test</td>
                        </tr>
                        <tr>
                            <td style="width: 40%">Airline</td>
                            <td>Test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .profile-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
        margin-bottom: 12px;
    }

    .profile-header__title {
        font-weight: bold;
        font-size: 15px;
        margin: 0;
    }

    .profile-content-body {
        height:84vh; 
        overflow-y: auto;
        padding-right: 10px;
    }

    .profile-content-body::-webkit-scrollbar {
        background: transparent;
    }

    .profile-content-body::-webkit-scrollbar-thumb {
       background: #007bff;
       border: 3px solid #FFFFFF;
       border-radius: 5px;
    }
</style>