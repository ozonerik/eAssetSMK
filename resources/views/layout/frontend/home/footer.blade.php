<footer class="page-footer dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="/">Home</a></li>
                        @auth
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li>
                        <form action="/logout" method="post" id="logout">
                        @csrf
                            <a href="#" onclick="document.getElementById('logout').submit()">Sign Out</a>
                        </form>
                        </li>
                        @else
                        <li><a href="/login">Sign In</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-sm-6">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="https://smkn1krangkeng.sch.id/">SMKN 1 Krangkeng</a></li>
                        <li><a href="mailto:ozonerik@gmail.com">Contact us</a></li>
                        <li><a href="https://github.com/ozonerik/eAssetSMK/issues">Report Issues</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>Copyright &copy; 2023 <a href="https://www.smkn1krangkeng.sch.id">smkn1krangkeng</a></p>
            <p class="float-right d-sm-inline-block">
                <b>Version</b> {{ versi() }}
            </p>
        </div>
    </footer>