<template>
    <div class="views">
        
        <div class="head">
            <i class="fas fa-user"></i>
            <span>Employer</span>
        </div>

        <div class="button_search">
            <button class="btn btn-primary rounded-0" @click="addModal = true">Ajouter un Employer <i class="fas fa-plus"></i></button>
            <div class="search">
                <input type="search" class="form-control rounded-0" placeholder="Rechercher un employer">
            </div>
        </div> 

        <div class="tableaux table-responsive">
            <table class="table table-hover table-striped ">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Poste</th>
                        <th scope="col">Département</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="emp in allEmp" :key="emp.id">
                        <td>{{ emp.nom }}</td>
                        <td>{{ emp.prenom }}</td>
                        <td>{{ emp.email }}</td>
                        <td>{{ getPostName(emp.poste_id) }}</td>
                        <td>{{ getDepName(emp.departement_id) }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h" ></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><span class="dropdown-item" @click="GetEmp(emp.id)" ><i class="fas fa-pen"></i> Modifier</span></li>
                                    <li><span class="dropdown-item" @click="DelEmp(emp.id)" > <i class="fas fa-trash" ></i> Supprimer</span></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
             <nav aria-label="Page navigation example" style="width: 100%;">
                <ul class="pagination justify-content-end w-100">
                    <li class="page-item" :class="currentPage === 1 ? 'disabled ' : ''">
                        <span class="page-link"  tabindex="-1" aria-disabled="true">Previous</span>
                    </li>
                   
                    <li class="page-item active" aria-current="page" v-for="page in totalPage" :key="page" :class="page === currentPage ? 'active' : ''">
                        <span class="page-link" @click="AllPoste(page)">{{ page }}</span>
                    </li>
                    
                    <li class="page-item" :class="currentPage === totalPage ? 'disabled' : ''">
                        <span class="page-link" >Next</span>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Add Employer -->
        <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un Employer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="addModal = false" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="floatingInput" placeholder="Photo de profile" @change="handleImg">
                            <label for="floatingInput">Photo de profil</label>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <input type="text" class="form-control" v-model="data.nom" id="floatingInput" placeholder="Nom">
                                <label for="floatingInput">Nom</label>
                            </div>
                            <div class="form-floating w-100">
                                <input type="text" class="form-control" v-model="data.prenom" id="floatingInput" placeholder="Prenom">
                                <label for="floatingInput">Prénom</label>
                            </div>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <input type="text" class="form-control" v-model="data.adresse" id="floatingInput" placeholder="Address">
                                <label for="floatingInput">Adress</label>
                            </div>
                            <div class="form-floating w-100">
                                <input type="number" class="form-control" v-model="data.tel" id="floatingInput" placeholder="Téléphone">
                                <label for="floatingInput">Téléphone</label>
                            </div>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <input type="email" class="form-control" v-model="data.email" id="floatingInput" placeholder="Email">
                                <label for="floatingInput">Email</label>
                            </div>
                            <div class="form-floating w-100">
                                <input type="date" class="form-control" v-model="data.naissance" id="floatingInput" placeholder="Date de Naissance">
                                <label for="floatingInput">Date de Naissance</label>
                            </div>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <select id="floatingInput" class="form-select" v-model="data.genre">
                                    <option selected disabled>Selectionnez un genre</option>
                                    <option value="Masculin">M</option>
                                    <option value="Féminin">F</option>
                                </select>
                                <label for="floatingInput">Genre</label>
                            </div>
                            <div class="form-floating w-100">
                                <select id="floatingInput" class="form-select" v-model="data.departement_id">
                                    <option selected disabled>Selectionnez un département</option>
                                    <option v-for="dep in allDeps" :key="dep.id" :value="dep.id">{{ dep.name }}</option>
                                </select>
                                <label for="floatingInput">Département</label>
                            </div>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <select id="floatingInput" class="form-select" v-model="data.poste_id">
                                    <option selected disabled>Selectionnez un poste</option>
                                    <option v-for="poste in allPoste" :key="poste.id" :value="poste.id">{{ poste.name }}</option>
                                </select>
                                <label for="floatingInput">Poste</label>
                            </div>
                            <div class="form-floating w-100">
                                <input type="date" class="form-control" v-model="data.date_embauche" id="floatingInput" placeholder="Date d'embauche">
                                <label for="floatingInput">Date d'embauche</label>
                            </div>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <select id="floatingInput" class="form-select" v-model="data.statut">
                                    <option selected disabled>Selectionnez un status</option>
                                    <option value="Temps plein">Temps plein</option>
                                    <option value="Temps partiel">Temps partiel</option>
                                    <option value="CDD">CDD</option>
                                    <option value="CDI">CDI</option>
                                </select>
                                <label for="floatingInput">Status d'emploie</label>
                            </div>
                            <div class="form-floating w-100">
                                <input type="text" class="form-control" v-model="data.salaire" id="floatingInput" placeholder="Salaire">
                                <label for="floatingInput">Salaire (FCFA)</label>
                            </div>
                        </div>
                        <div class="rows mb-3">
                            <div class="form-floating w-100">
                                <input type="text" class="form-control" v-model="data.info_urgence" id="floatingInput" placeholder="Appelle en cas d'urgence">
                                <label for="floatingInput">Appelle en cas d'urgence</label>
                            </div>
                            <div class="form-floating w-100">
                                <input type="password" disabled class="form-control" id="floatingInput" placeholder="Mots de passe">
                                <label for="floatingInput">Mot de passe</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger rounded-0" @click="addModal = false" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary rounded-0" @click="AddEmp" >Enrégistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Employer -->
        <!-- Update Employer -->
            <div v-if="updateModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter un Employer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" @click="updateModal = false" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                            <div v-if="getemp.photo == null" class="form-floating mb-3">
                                <input type="file" class="form-control" id="floatingInput" placeholder="Photo de profile" @change="handleImgUpdate">
                                <label for="floatingInput">Photo de profil</label>
                            </div>
                            <div v-else class="photo">
                                <div  class="imageUpdate mb-3">
                                    <img :src="getemp.photo" alt="">
                                </div>
                                <button class="btn btn-danger" @click="DelImage"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control" v-model="getemp.nom" id="floatingInput" placeholder="Nom">
                                    <label for="floatingInput">Nom</label>
                                </div>
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control" v-model="getemp.prenom" id="floatingInput" placeholder="Prenom">
                                    <label for="floatingInput">Prénom</label>
                                </div>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control" v-model="getemp.adresse" id="floatingInput" placeholder="Address">
                                    <label for="floatingInput">Adress</label>
                                </div>
                                <div class="form-floating w-100">
                                    <input type="number" class="form-control" v-model="getemp.tel" id="floatingInput" placeholder="Téléphone">
                                    <label for="floatingInput">Téléphone</label>
                                </div>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <input type="email" class="form-control" v-model="getemp.email" id="floatingInput" placeholder="Email">
                                    <label for="floatingInput">Email</label>
                                </div>
                                <div class="form-floating w-100">
                                    <input type="date" class="form-control" v-model="getemp.naissance" id="floatingInput" placeholder="Date de Naissance">
                                    <label for="floatingInput">Date de Naissance</label>
                                </div>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <select id="floatingInput" class="form-select" v-model="getemp.genre">
                                        <option selected disabled>Selectionnez un genre</option>
                                        <option value="Masculin">M</option>
                                        <option value="Féminin">F</option>
                                    </select>
                                    <label for="floatingInput">Genre</label>
                                </div>
                                <div class="form-floating w-100">
                                    <select id="floatingInput" class="form-select" v-model="getemp.departement_id">
                                        <option selected disabled>Selectionnez un département</option>
                                        <option v-for="dep in allDeps" :key="dep.id" :value="dep.id">{{ dep.name }}</option>
                                    </select>
                                    <label for="floatingInput">Département</label>
                                </div>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <select id="floatingInput" class="form-select" v-model="getemp.poste_id">
                                        <option selected disabled>Selectionnez un poste</option>
                                        <option v-for="poste in allPoste" :key="poste.id" :value="poste.id">{{ poste.name }}</option>
                                    </select>
                                    <label for="floatingInput">Poste</label>
                                </div>
                                <div class="form-floating w-100">
                                    <input type="date" class="form-control" v-model="getemp.date_embauche" id="floatingInput" placeholder="Date d'embauche">
                                    <label for="floatingInput">Date d'embauche</label>
                                </div>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <select id="floatingInput" class="form-select" v-model="getemp.statut">
                                        <option selected disabled>Selectionnez un status</option>
                                        <option value="Temps plein">Temps plein</option>
                                        <option value="Temps partiel">Temps partiel</option>
                                        <option value="CDD">CDD</option>
                                        <option value="CDI">CDI</option>
                                    </select>
                                    <label for="floatingInput">Status d'emploie</label>
                                </div>
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control" v-model="getemp.salaire" id="floatingInput" placeholder="Salaire">
                                    <label for="floatingInput">Salaire (FCFA)</label>
                                </div>
                            </div>
                            <div class="rows mb-3">
                                <div class="form-floating w-100">
                                    <input type="text" class="form-control" v-model="getemp.info_urgence" id="floatingInput" placeholder="Appelle en cas d'urgence">
                                    <label for="floatingInput">Appelle en cas d'urgence</label>
                                </div>
                                <div class="form-floating w-100">
                                    <input type="password" v-model="getemp.password" class="form-control" id="floatingInput" placeholder="Mots de passe">
                                    <label for="floatingInput">Mot de passe</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger rounded-0" @click="updateModal = false" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary rounded-0" @click="UpdateEmp">Modifier</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Update Employer -->

    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2'
export default {
    data() {
        return {
            addModal: false,
            updateModal: false,
            data: {
                nom: '',
                prenom: '',
                adresse: '',
                tel: '',
                email: '',
                naissance: '',
                genre: '',
                departement_id: '',
                poste_id: '',
                date_embauche: '',
                statut: '',
                salaire: '',
                info_urgence: '',
                password: 'password',
                photo:''
            },
            allDeps: {},
            allPoste: {},
            allEmp: {},
            currentPage: 1,
            totalPage: 6,
            getemp:{}
        }
    },
    methods: {
        async Departement() {
            try {
                const res = await axios.get('/depart');
                if (res.status === 200) { // Vérifie le statut de la réponse
                    this.allDeps = res.data.departements;
                    console.log(this.allDeps);
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des départements :', error);
            }
        },
        async Poste() {
            try {
                const res = await axios.get('/poste')
                if (res.status === 200) {
                    this.allPoste = res.data.postes
                    console.log(this.allPoste)
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des Poste :', error);
            }
        },
        async handleImg(event) {
            const selectImg = event.target.files[0]
            if (selectImg && selectImg.type.startsWith('image/')) {
                const formData = new FormData()
                formData.append('photo', selectImg)

                try {

                    const res = await axios.post('/uploadPhoto', formData)
                    if (res.status === 200) {
                        this.data.photo = res.data.image_url
                    } 
                    
                } catch (error) {
                    console.error('Erreur ce trouve ici : ', error)
                }
            }
        },
        async AddEmp() {
            try {

                if (this.data.nom.trim()== "" || this.data.prenom.trim() == "" || this.data.adresse.trim() == "" || this.data.tel == "" || this.data.email.trim() == "" || this.data.naissance == "" || this.data.genre.trim() == "" || this.data.departement_id == "" || this.data.poste_id == "" || this.data.date_embauche == "" || this.data.statut.trim() == "" || this.data.salaire.trim() == "" || this.data.info_urgence.trim() == "" || this.data.photo.trim() == "") {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        title: "Veuillez remplir tous les champs",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "error"
                    })
                    this.addModal = true
                } else {
                    const res = await axios.post('/create', this.data)
                    if (res.status === 200) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Employer enrégistrer avec succès",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: "success"
                        })

                        this.allEmp.unshift(res.data.emp)
                        this.data.nom = ""
                        this.data.prenom = ""
                        this.data.adresse = ""
                        this.data.tel = ""
                        this.data.email = ""
                        this.data.naissance = ""
                        this.data.genre = ""
                        this.data.departement_id = ""
                        this.data.poste_id = ""
                        this.data.date_embauche = ""
                        this.data.statut = ""
                        this.data.salaire = ""
                        this.data.info_urgence = ""
                        this.data.password = ""
                        this.data.photo = ""

                        this.addModal = false

                    }
                }
                
                
            } catch (error) {
                console.error("Erreur trouver ici :", error)
            }
        },
        async AllEmp(page) {
            const res = await axios.get('/allEmp?page=' + page)
            if (res.status === 200) {
                this.allEmp = res.data.Emps.data
                this.currentPage = res.data.Emps.current_page
                this.totalPage = res.data.Emps.last_page
            }

        },
        getDepName(id) {
            const departement = this.allDeps.find(dep => dep.id === id)
            return departement ? departement.name : ""
        },
        getPostName(id) {
            const poste = this.allPoste.find(post => post.id === id)
            return poste ? poste.name : ""
        },
        async GetEmp(id) {
            this.updateModal = true
            const res = await axios.get('/getEmp/' + id)
            if (res.status === 200) {
                this.getemp = res.data.emp
                console.log(this.getemp)
            }
        },
        async DelImage() {
            const res = await axios.post('/delImage', { photo: this.getemp.photo })
            if (res.status === 200) {
                this.getemp.photo = null
            }
        },
        async UpdateEmp() {
            try {

                if (this.getemp.nom.trim() == "" || this.getemp.prenom.trim() == "" || this.getemp.adresse.trim() == "" || this.getemp.tel == "" || this.getemp.email.trim() == "" || this.getemp.naissance == "" || this.getemp.genre.trim() == "" || this.getemp.departement_id == "" || this.getemp.poste_id == "" || this.getemp.date_embauche == "" || this.getemp.statut.trim() == "" || this.getemp.salaire.trim() == "" || this.getemp.info_urgence.trim() == "" || this.getemp.photo.trim() == "") {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        title: "Veuillez remplir tous les champs",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "error"
                    })
                    this.updateModalModal = true
                } else {
                    const res = await axios.post('/updateEmp', this.getemp)
                    if (res.status === 200) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Employer modifier avec succès",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: "success"
                        })
                        const index = this.allEmp.findIndex(emp => emp.id === this.getemp.id)
                        if (index !== -1) {
                            this.allEmp[index] = this.getemp
                        }
                        this.getemp = {}
                        this.updateModal = false
                    }
                }
                
            } catch (error) {
                console.error(error)
            }
        },
        async handleImgUpdate(event) {
            const selectImg = event.target.files[0]
            if (selectImg && selectImg.type.startsWith('image/')) {
                const formData = new FormData()
                formData.append('photo', selectImg)

                try {

                    const res = await axios.post('/uploadPhoto', formData)
                    if (res.status === 200) {
                        this.getemp.photo = res.data.image_url
                    }

                } catch (error) {
                    console.error('Erreur ce trouve ici : ', error)
                }
            }
        },
        async DelEmp(id) {
            const res = await axios.get('/getEmp/' + id)
            if (res.status === 200) {
                this.getemp = res.data.emp

                 Swal.fire({
                    title: "Voulez-vous supprimer ce Département ?",
                    text: "Vous ne pourrez plus revenir en arrière !",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText: "Fermer"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const delImage = await axios.post('/delImage', { photo: this.getemp.photo })
                        const ress = await axios.post('/delEmp', this.getemp)
                        if (delImage.status == 200 && ress.status === 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Suppression effectuer",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            
                            const index = this.allEmp.findIndex(emp => emp.id === this.getemp.id)
                            if (index !== -1) {
                                this.allEmp.splice(index, 1)
                            }
                            this.getemp = {}
                        }
                    }
                })
            }
        }
    },
    created(){
        this.Departement()
        this.Poste()
        this.AllEmp()
    }
}
</script>

<style>
    .head{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        width: 100%;
        height: 60px;
    }
    .head i{
        width: 40px;
        height: 40px;
        background: #050030;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 19px;
        border-radius: 10px;
    }
    .head span{
        font-size: 22px;
        font-weight: 500;
    }
    .button_search{
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 70px;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
    }
    .button_search .search{
        width: 300px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tableaux{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
        gap: 10px;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
    }
    .rows{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
    }
    .photo{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 15px;
    }
    .imageUpdate{
        width: 15%;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .imageUpdate img{
        max-width: 100%;
        max-height: 100%;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>