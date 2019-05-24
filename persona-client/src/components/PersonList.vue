<template>
<div class="container">
    <div v-if="list">
        <div class="form-inline col-md-6 ">
            <label>Buscar:</label>
            <input type="text" class="form-control" v-model="search" placeholder="Buscar nombre.."/>
        </div>
        <br>
        <p class="h1">Listado de personas</p>
        <span class="help is-info"  v-if="isLoading">Loading...</span>
        <table class="table " v-else>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Fecha nacimiento</th>
                    <th>No. identificación</th>
                    <th>Cantidad de hijos</th>
                    <th>Raza</th>
                    <th>Salario</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="(person,index) in personaslist">
                <tr v-bind:key="person.id">
                    <td>{{person.id}}</td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                            <input v-model="person.name" type="text" class="form-control">
                        </span>
                        <span v-else>
                           {{ person.name }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                           <input v-model="person.surnames" type="text" class="form-control">
                        </span>
                        <span v-else>
                           {{ person.surnames }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                           <input v-model="person.age" type="text" class="form-control">
                        </span>
                        <span v-else>
                            {{ person.age }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                            <input v-model="person.gender" type="text" class="form-control">
                        </span>
                        <span v-else>
                            {{ person.gender }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                             <input v-model="person.birthDate" type="text" class="form-control">
                        </span>
                        <span v-else>
                            {{ person.birthDate|formatDate }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                            <input v-model="person.identificationNumber" type="text" class="form-control">
                        </span>
                        <span v-else>
                            {{ person.identificationNumber }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                            <input v-model="person.childrenAmount" type="text" class="form-control">
                        </span>
                        <span v-else>
                            {{ person.childrenAmount }}
                        </span>
                    </td>
                    <td>
                        <span v-if="formActualizar  && idActualizar == index">
                            <input v-model="person.race" type="text" class="form-control">
                        </span>
                        <span v-else>
                                {{ person.race }}
                        </span>
                    </td>
                    <td>
                            <span v-if="formActualizar  && idActualizar == index">
                                <!-- Formulario para actualizar -->
                                <input v-model="person.salary" type="text" class="form-control">
                            </span>
                        <span v-else>
                                <!-- Dato nombre -->
                                {{ person.salary }}
                            </span>
                    </td>
                    <td>
                            <span v-if="formActualizar  && idActualizar == index">
                                <input v-model="person.charge" type="text" class="form-control">
                            </span>
                        <span v-else>
                                {{ person.charge }}
                            </span>
                    </td>
                    <td>
                             <span v-if="formActualizar && idActualizar == index">
                                 <button @click="updateRecord(index,person.id)" class="btn btn-success">Guardar</button>
                            </span>
                        <span v-else>
                                <button @click="verFormActualizar(index)" class="btn btn-warning text-white">Actualizar</button>

                                <button @click="deleteRecord(index,person.id)" class="btn btn-danger">Eliminar</button>
                            </span>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

        <button @click="addRecord()" class="btn btn-success">Crear nueva persona</button>

    </div>
    <div v-else>
        <persona-form @completed="addPersona"></persona-form>
    </div>

	</div>
</template>

<script>
import axios from 'axios'
import PersonaForm from './PersonCreate'


export default {
    components: {
        PersonaForm
    },
    data() {
        return {
			search: '',
            persons: {},
            formActualizar: false,
            list: true,
			isLoading: true,
            idActualizar: -1,
        };

    },
    async created () {
        const response = await axios.get('http://localhost/persona/public/index.php/api/people');
        this.persons = response.data;
        this.isLoading = false
    },
    methods: {
        /*onSubmit(person) {
            //Vue.set(person.id,person.name)
        },*/
        addPersona(person) {
            this.persons.push(person)
        },
        verFormActualizar: function (index) {
            this.idActualizar = index;
            this.formActualizar = true;
        },
        addRecord: function () {
            this.list = false;
        },
        updateRecord: function(index, id){
            var name = this.persons[index].name;
            var surnames = this.persons[index].surnames;
            var gender = this.persons[index].gender;
            var birthDate = this.persons[index].birthDate;
            var identificationNumber = this.persons[index].identificationNumber;
            var childrenAmount = this.persons[index].childrenAmount;
            var race = this.persons[index].race;
            var salary = this.persons[index].salary;
            var charge = this.persons[index].charge;
            var age = this.persons[index].age;
            if (name != ''){
                axios.put('http://localhost/persona/public/index.php/api/people/' + id,{
                    name: name,
                    age : Number(age),
                    childrenAmount : Number(childrenAmount),
                    surnames: surnames,
                    gender: gender,
                    birthDate: birthDate,
                    identificationNumber: identificationNumber,
                    race: race,
                    salary: salary,
                    charge: charge,
                }).then(function () {
                    this.formActualizar = false;
                }.bind(this));
            }
        },
       deleteRecord: function(index,id){
            axios.delete('http://localhost/persona/public/index.php/api/people/' +  id)
            .then(function () {
                this.persons.splice(index, 1);
            }.bind(this));
       }
	},
    computed: {
        personaslist() {
            return this.persons.filter(person => {
                return person.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>