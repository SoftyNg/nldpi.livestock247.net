<div class="content-wrapper">

    <h1>Registries</h1>

    <div class="description">

        The Backbone of Nigeria’s Livestock Data Management — Secure Registration and Documentation for All Key Players in the National Livestock Ecosystem.

    </div>

    <?php

        if (isset($_SESSION['success'])) {

            require_once 'success.php'; 

        }

    ?>

    <div class="service-container">

        <div class="service-container-1">



            <div class="service">

                <h5>Livestock Identification Service Providers</h5>

                <p>Register your company to offer verified animal identification services, request unique identification numbers, and contribute to national livestock traceability.</p>

                <div>

                    <a href="<?= BASE_URL?>service_providers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry/service_providers_registry" class="btn btn-view-registry" >View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Veterinary Professionals</h5>

                <p>Register to provide and document animal health services, supporting disease control and livestock welfare.</p>

                <div>

                    <a href="<?= BASE_URL?>veterinary_professionals/register" class="btn btn-success">Register</a>

                    <a href="<?= BASE_URL?>digital_registry/veterinary_service_public" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Livestock Transporters</h5>

                <p>Register to digitally manage livestock transportation, ensuring traceability, health tracking, and compliance with regulations.</p>

                <div>

                    <a href="<?= BASE_URL?>transporters/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Livestock Farmers & Keepers</h5>

                <p>Register to manage livestock records digitally, track health and movement, and gain access to official documentation.</p>

                <div>

                    <a href="<?= BASE_URL?>livestock_keepers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>        



            <div class="service">

                <h5>Breeding Centers</h5>

                <p>Register your facility to provide breeding services, list available programs, and connect with livestock owners.</p>

                <div>

                    <a href="<?= BASE_URL?>breeding_centers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>   



            <div class="service">

                <h5>Grazing Lands & Facilities</h5>

                <p>List available pastures, barns, and housing facilities, providing details on location, size, and capacity.</p>

                <div>

                    <a href="<?= BASE_URL?>grazing_facilities/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Processing Centers</h5>

                <p>Register facilities that process meat, milk, and hides, providing location and available services.</p>

                <div>

                    <a href="<?= BASE_URL?>processing_centers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Veterinary Clinics</h5>

                <p>Register animal healthcare facilities with details on location, operating hours, and services offered.</p>

                <div>

                    <a href="<?= BASE_URL?>veterinary_clinics/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Feed Manufacturers</h5>

                <p>List companies producing animal feed, specifying product types and availability.</p>

                <div>

                    <a href="<?= BASE_URL?>feed_manufacturers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Technical Specialists</h5>

                <p>Register as an expert in livestock nutrition, breeding, disease control, or farm management.</p>

                <div>

                    <a href="<?= BASE_URL?>technical_specialists/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Quarantine Centers</h5>

                <p>Register facilities that isolate animals for disease prevention, providing capacity and available services.</p>

                <div>

                    <a href="<?= BASE_URL?>quarantine_centers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



            <div class="service">

                <h5>Extension Workers</h5>

                <p>Register as a field officer providing training and support to farmers, including regions covered and areas of expertise.</p>

                <div>

                    <a href="<?= BASE_URL?>extension_workers/register" class="btn btn-success mr-4">Register</a>

                    <a href="<?= BASE_URL?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>

            <div class="service">

                <h5>Vehicle Registration</h5>

                <p>

                    Register your vehicle for the transportation of livestock. Ensure compliance with health, safety, and traceability standards across covered regions.

                </p>

                <div class="mt-3">

                    <a href="<?= BASE_URL ?>vehicle_registration/register" class="btn btn-success mr-3"> Register</a>

                    <a href="<?= BASE_URL ?>digital_registry" class="btn btn-view-registry">View Registry</a>

                </div>

            </div>



        </div>

    </div>           

</div>

