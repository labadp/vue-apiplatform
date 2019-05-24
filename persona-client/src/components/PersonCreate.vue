<template>
    <div class="bd-example">
        <p class="h4">Insertar nueva persona</p>
        <form @submit="onSubmit">
            <!--<span class="help is-danger" v-text="errors"></span>-->
            <p v-if="errors.length">
                <b>Por favor, inserte los datos correctamente:</b>
                <ul>
                    <li v-for="error in errors" class="alert alert-danger">{{ error }}</li>
                </ul>
            </p>
            <span>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control"  placeholder="Insertar nombre..." v-model="name" @keydown="errors = ''">
                </div>
                <div class="form-group col-md-6">
                    <label >Apellidos</label>
                    <input type="text" class="form-control"  placeholder="Insertar apellidos..." v-model="surnames" @keydown="errors = ''">
                </div>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >Edad</label>
                        <input class="form-control" type="number" placeholder="insertar edad..." v-model="age" @keydown="errors = ''">
                    </div>
                    <div class="form-group col-md-6">
                        <label >Sexo</label>
                        <select class="form-control">
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                 </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >Fecha de nacimiento</label>
                        <input class="form-control" type="date" placeholder="insertar fecha de nacimiento..." v-model="birthDate" @keydown="errors = ''">
                    </div>
                    <div class="form-group col-md-6">
                        <label >No. Identificación</label>
                        <input class="form-control" type="text" placeholder="insertar no. identificacion..." v-model="identificationNumber" @keydown="errors = ''">

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >Cantidad de hijos</label>
                        <input class="form-control" type="number" placeholder="insertar cantidad de hijos ..." v-model="childrenAmount" @keydown="errors = ''">
                    </div>
                    <div class="form-group col-md-6">
                        <label >Raza</label>
                        <input class="form-control" type="text" placeholder="insertar raza..." v-model="race" @keydown="errors = ''">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >Salario</label>
                        <input class="form-control" type="text" placeholder="insertar salario..." v-model="salary" @keydown="errors = ''">
                    </div>
                    <div class="form-group col-md-6">
                        <label >Cargo</label>
                        <input class="form-control" type="text" placeholder="insertar cargo..." v-model="charge" @keydown="errors = ''">
                    </div>
                </div>
            </span>

            <button type="submit" class="button is-primary"> Agregar Persona</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data()
        {
            return {
                age: 0,
                name: '',
                surnames: '',
                gender: '',
                birthDate: '',
                identificationNumber: '',
                childrenAmount: 0,
                race: '',
                salary: '',
                charge: '',
                errors: '',
                isLoading: false
            }
        },
        methods: {
            onSubmit(e) {
                e.preventDefault();
               // this.isLoading = true;
                this.errors = [];

                if (!this.name) this.errors.push('Debe insertar el nombre');
                if (!this.surnames) this.errors.push('Debe insertar los apellidos');
                if (!this.age) this.errors.push('Debe insertar la edad');
                if (!this.birthDate) this.errors.push('Debe insertar la fecha de nacimiento');
                if (!this.identificationNumber) this.errors.push('Debe insertar el numero de identificación');
                if (!this.race) this.errors.push('Debe insertar la raza');
                if (!this.salary) this.errors.push('Debe insertar el salario');
                if (!this.charge) this.errors.push('Debe insertar el cargo');
                if (!this.errors.length) this.postPersona();

            },
            async postPersona() {
                this.$data.age = Number(this.$data.age);
                this.$data.childrenAmount = Number(this.$data.childrenAmount);
                axios.post('http://localhost/persona/public/index.php/api/people', this.$data)
                    .then(response => {
                        this.name = '';
                        this.surnames = '';
                        this.age =0;
                        this.gender = '';
                        this.birthDate = '';
                        this.identificationNumber = '';
                        this.childrenAmount = '';
                        this.race = '';
                        this.salary = '';
                        this.charge = '';
                        this.isLoading = false;
                        this.$emit('completed', response.data)
                    }).then(function () {
                    this.$parent.list = true;
                }.bind(this))
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.isLoading = false
                    });
            }
        }
    }
</script>