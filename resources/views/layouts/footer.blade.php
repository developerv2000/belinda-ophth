<footer class="footer">
    <div class="main-container footer__inner">
        <nav class="footer__nav">
            <ul>
                <li>
                    <a @if ($route == 'home') class="active" @endif href="{{ route('home') }}">Главная</a>
                </li>

                <li>
                    <a @if ($route == 'researches.index') class="active" @endif href="{{ route('researches.index') }}">Исследования</a>
                </li>

                <li>
                    <a @if ($route == 'products.index') class="active" @endif href="{{ route('products.index') }}">Продукты</a>
                </li>
            </ul>
        </nav>

        <div class="footer__main">
            <p class="copyright">
                © {{ date('Y') }} Belinda Ophthalmology.<br> Все права защищены.
            </p>

            <div class="footer__contacts">
                <div class="footer__socials-container">
                    <p>Следите за нами в<br> социальных сетях</p>
                    <div class="footer__socials">
                        <a href="https://www.facebook.com/BelindaOphthalmology" target="_blank">
                            @include('svgs.facebook')
                        </a>

                        <a href="https://www.instagram.com/belindaophthalmology/" target="_blank">
                            @include('svgs.instagram')
                        </a>
                    </div>
                </div>

                <form action="#" class="mailing-form" id="mailing-form" onsubmit="submitMailing(event)">
                    <input type="email" id="mailing-input" placeholder="Подпишитесь на нашу E-mail рассылку" required autocomplete="off">
                    <button type="submit" class="submit-mailing" id="submit-mailing-button"><span class="material-icons-outlined" id="submit-mailing-icon">email</span></button>
                    <button type="button" class="cancel-mailing" onclick="cancelMailing()">Отписаться от рассылки</button>
                </form>
            </div>

            <button class="scroll-top" id="scroll-top">
                <span class="material-icons-outlined scroll-top__icon">keyboard_arrow_up</span>
                <span class="scroll-top__text">Вернутся <br> вверх</span>
            </button>

        </div>
    </div>
</footer>
