<template>
    <div class="card  col-md-5">
      <div class="card-body">
        <h2 class="card-title mb-3 text-center">{{ variables.rate.name }}</h2>
        <hr>
        <p class="text-center">{{ variables.rate.description }}</p>
        <div class="row">
          <div class="col-6 col-md-4">
            <div class="d-flex mt-4">
              <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                  <i class="ri-money-dollar-box-fill"></i>
                </div>
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Precio:</p>
                <h6 class="text-truncate mb-0">$1500</h6>
              </div>
            </div>
          </div>
          <!--end col-->
          <div class="col-6 col-md-4">
            <div class="d-flex mt-4">
              <div class="flex-shrink-0 avatar-xs align-self-center mx-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                  <i class="ri-money-dollar-box-fill"></i>
                </div>
              </div>
              <div class="overflow-hidden">
                <p class="mb-1">Precio Por Persona:</p>
                <a href="#" class="fw-semibold">$1500</a>
              </div>
            </div>
          </div>
          <!--end col-->
        </div>
        <!--end row-->
      </div>
      <!--end card-body-->
    </div><!-- end card -->
  </template>
  
  <script>
  export default {
    props: {
      variables: Object,
    },
  };
  </script>
  