<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f5f0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background: linear-gradient(135deg, #6B8E23 0%, #98FF98 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 32px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .content {
            padding: 40px 30px;
            background-color: #ffffff;
        }
        .welcome-text {
            color: #3B2F2F;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .user-name {
            color: #6B8E23;
            font-weight: bold;
            font-size: 24px;
        }
        .benefits {
            background-color: #F5F5DC;
            border-left: 4px solid #8B5E3C;
            padding: 20px;
            margin: 30px 0;
            border-radius: 8px;
        }
        .benefits h2 {
            color: #8B5E3C;
            margin-top: 0;
            font-size: 20px;
        }
        .benefits ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .benefits li {
            padding: 10px 0;
            color: #4B4B4B;
            position: relative;
            padding-left: 30px;
        }
        .benefits li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #6B8E23;
            font-weight: bold;
            font-size: 20px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #6B8E23 0%, #556B1A 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(107, 142, 35, 0.3);
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            background: linear-gradient(135deg, #556B1A 0%, #6B4529 100%);
            box-shadow: 0 6px 20px rgba(107, 142, 35, 0.4);
        }
        .products-preview {
            display: table;
            width: 100%;
            margin: 30px 0;
        }
        .product-item {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 15px;
            vertical-align: top;
        }
        .product-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #F4C430 0%, #8B5E3C 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }
        .product-name {
            color: #8B5E3C;
            font-weight: bold;
            font-size: 14px;
        }
        .discount-banner {
            background: linear-gradient(135deg, #8B0000 0%, #FF8C00 100%);
            color: #ffffff;
            padding: 25px;
            text-align: center;
            border-radius: 8px;
            margin: 30px 0;
        }
        .discount-code {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 10px 0;
            display: inline-block;
            border: 2px dashed #ffffff;
        }
        .footer {
            background-color: #3B2F2F;
            color: #F5F5DC;
            padding: 30px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #F4C430;
            text-decoration: none;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #F4C430;
            text-decoration: none;
            font-size: 24px;
            transition: color 0.3s ease;
        }
        .social-links a:hover {
            color: #FFD700;
        }
        @media only screen and (max-width: 600px) {
            .product-item {
                display: block;
                width: 100%;
                margin-bottom: 20px;
            }
            .content {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🌿 ¡Bienvenido a Secos y Saludables JPJ! 🌿</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="welcome-text">
                Hola <span class="user-name">{{ $name }}</span>,
            </p>
            
            <p class="welcome-text">
                ¡Estamos encantados de tenerte con nosotros! Has tomado una excelente decisión al unirte a nuestra comunidad de amantes de los productos naturales y saludables.
            </p>

            <!-- Benefits Section -->
            <div class="benefits">
                <h2>🎁 Beneficios de ser miembro:</h2>
                <ul>
                    <li>Acceso exclusivo a ofertas especiales</li>
                    <li>Descuentos en productos seleccionados</li>
                    <li>Envío gratis en compras superiores a $50.000</li>
                    <li>Recetas y tips de alimentación saludable</li>
                    <li>Puntos de recompensa en cada compra</li>
                </ul>
            </div>

            <!-- Discount Banner -->
            <div class="discount-banner">
                <h2 style="margin: 0 0 10px 0; font-size: 22px;">🎉 Regalo de Bienvenida 🎉</h2>
                <p style="margin: 10px 0; font-size: 16px;">Usa este código en tu primera compra:</p>
                <div class="discount-code">BIENVENIDO15</div>
                <p style="margin: 10px 0; font-size: 14px;">15% de descuento en tu primer pedido</p>
            </div>

            <!-- Products Preview -->
            <h2 style="color: #8B5E3C; text-align: center; margin: 40px 0 20px;">Nuestros Productos Destacados</h2>
            <div class="products-preview">
                <div class="product-item">
                    <div class="product-icon">🥜</div>
                    <div class="product-name">Frutos Secos Premium</div>
                </div>
                <div class="product-item">
                    <div class="product-icon">🍫</div>
                    <div class="product-name">Chocolates Artesanales</div>
                </div>
                <div class="product-item">
                    <div class="product-icon">🌱</div>
                    <div class="product-name">Semillas Orgánicas</div>
                </div>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $shopUrl }}" class="cta-button">Comenzar a Comprar</a>
            </div>

            <p class="welcome-text" style="margin-top: 30px;">
                Si tienes alguna pregunta, no dudes en contactarnos. Estamos aquí para ayudarte en tu camino hacia una alimentación más saludable.
            </p>

            <p class="welcome-text">
                ¡Gracias por confiar en nosotros!<br>
                <strong style="color: #6B8E23;">El equipo de {{ config('app.name') }}</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="social-links">
                <a href="{{ $facebookUrl ?? '#' }}"><i class="icon/icons8-facebook-nuevo.svg"></i></a>
                <a href="{{ $instagramUrl ?? '#' }}"><i class="icon/icons8-instagram.svg"></i></a>
                <a href="{{ $whatsappUrl ?? '#' }}"><i class="icon/icons8-whatsapp-96.png"></i></a>
            </div>
            
            <p style="margin: 10px 0;">
                © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
            </p>
            
            <p style="margin: 10px 0; font-size: 12px;">
                Recibiste este correo porque te registraste en nuestro sitio web.<br>
                <a href="{{ $unsubscribeUrl ?? '#' }}">Darse de baja</a> | 
                <a href="{{ $preferencesUrl ?? '#' }}">Preferencias de correo</a>
            </p>
            
            <p style="margin: 10px 0; font-size: 12px; color: #8B7765;">
                {{ $address ?? 'Santiago, Chile' }}
            </p>
        </div>
    </div>
</body>
</html>
