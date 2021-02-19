<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Mantenimiento
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Contrato</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link"  href="#"><i class="icon-bag"></i> Contrato</a>
                            </li>
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link"  href="#"><i class="icon-bag"></i> Funciones</a>
                            </li>
                               <li @click="menu=15" class="nav-item">
                                <a class="nav-link"  href="#"><i class="icon-bag"></i> Tipo Contrato</a>
                            </li>
                            </li>
                               <li @click="menu=18" class="nav-item">
                                <a class="nav-link"  href="#"><i class="icon-bag"></i> Categoria</a>
                            </li>
                            </li>
                               <li @click="menu=19" class="nav-item">
                                <a class="nav-link"  href="#"><i class="icon-bag"></i> Unidad Academica</a>
                            </li>
                        </ul>
                    </li>
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Empleado</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Actividad</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=11" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Actividad</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Tipo Actividad</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> SubActividad</a>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Horario</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Resultado</a>
                            </li> 
                             <li @click="menu=17" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Acronimo </a>
                            </li> 
                            </li>
                                                        
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                             <li @click="menu=12" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Generalidades</a>
                            </li>
                             <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Horario Control</a>
                            </li>
                        </ul>
                    </li>
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>