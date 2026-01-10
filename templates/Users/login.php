<?php
/**
 * @var \App\View\AppView $this
 */
$redirect = $this->request->getQuery('redirect');
$formUrl = ['action' => 'login'];
if ($redirect) {
    $formUrl['?'] = ['redirect' => $redirect];
}
$this->setLayout('auth');
$this->assign('title', __('Login'));

$emailError = $this->Form->isFieldError('email');
$passwordError = $this->Form->isFieldError('password');
?>
<div class="auth-grid">
    <section class="auth-card" data-animate="card" style="--delay: 0.05s">
        <div class="auth-card__brand">
            <span class="brand-mark" aria-hidden="true"></span>
            <div>
                <span class="brand-name">DiceRPG</span>
                <span class="brand-subtitle"><?= __('Modern RPG companion') ?></span>
            </div>
        </div>

        <header class="auth-card__header">
            <h1><?= __('Bem-vindo de volta') ?></h1>
            <p><?= __('Entre para continuar sua jornada.') ?></p>
        </header>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create(null, ['url' => $formUrl, 'class' => 'auth-form', 'data-auth-form' => 'login']) ?>
            <?php if ($redirect): ?>
                <?= $this->Form->hidden('redirect', ['value' => $redirect]) ?>
            <?php endif; ?>

            <div class="field<?= $emailError ? ' field--error' : '' ?>">
                <input
                    type="email"
                    id="login-email"
                    name="email"
                    autocomplete="email"
                    required
                    class="field__input"
                    placeholder=" "
                    value="<?= h($this->request->getData('email')) ?>"
                    aria-invalid="<?= $emailError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="login-email"><?= __('Email') ?></label>
                <?= $this->Form->error('email', null, ['class' => 'field__error']) ?>
            </div>

            <div class="field field--has-action<?= $passwordError ? ' field--error' : '' ?>">
                <input
                    type="password"
                    id="login-password"
                    name="password"
                    autocomplete="current-password"
                    required
                    class="field__input"
                    placeholder=" "
                    data-password-input
                    aria-invalid="<?= $passwordError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="login-password"><?= __('Senha') ?></label>
                <button
                    class="field__action"
                    type="button"
                    data-toggle-password
                    data-target="#login-password"
                    aria-label="<?= __('Mostrar senha') ?>"
                    aria-pressed="false"
                >
                    <svg class="field__eye" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                        <path class="field__eye-slash" d="M4 4l16 16"></path>
                    </svg>
                </button>
                <?= $this->Form->error('password', null, ['class' => 'field__error']) ?>
            </div>

            <div class="auth-form__row">
                <a class="auth-link" href="#"><?= __('Esqueceu a senha?') ?></a>
            </div>

            <button class="btn btn-primary" type="submit">
                <?= __('Entrar') ?>
            </button>

            <p class="auth-form__footer">
                <?= __('Nao tem conta?') ?>
                <a class="auth-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">
                    <?= __('Criar conta') ?>
                </a>
            </p>
        <?= $this->Form->end() ?>
    </section>

    <?= $this->element('auth_side_panel', [
        'image' => 'login.png',
        'tag' => __('Portal de acesso'),
        'title' => __('Sua guilda esta pronta'),
        'subtitle' => __('Gerencie campanhas, fichas e rolagens com estilo moderno.'),
        'items' => [
            __('Painel de campanhas sempre sincronizado'),
            __('Notas e mapas em um unico lugar'),
            __('Interface leve com brilho sutil'),
        ],
        'alt' => __('Login illustration'),
    ]) ?>
</div>
<?php echo $this->Html->script('auth', ['block' => true, 'type' => 'module']); ?>