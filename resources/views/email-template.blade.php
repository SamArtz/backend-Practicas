<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Resumen de compra</title>
</head>
<body style="margin:0; padding:0; background:#f6f7fb; font-family: Arial, Helvetica, sans-serif; color:#111827;">
  <!-- Wrapper -->
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f6f7fb; padding:24px 12px;">
    <tr>
      <td align="center">
        <!-- Container -->
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px; width:100%; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 6px 24px rgba(17,24,39,0.08);">
          <!-- Header -->
          <tr>
            <td style="padding:20px 24px; background:#111827;">
              <div style="color:#ffffff; font-size:18px; font-weight:700; line-height:1.2;">
                Confirmación de compra
              </div>
              <div style="color:#cbd5e1; font-size:13px; margin-top:6px;">
                Resumen de tu pedido
              </div>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:24px;">
              <h1 style="margin:0 0 8px 0; font-size:22px; line-height:1.3; color:#111827;">
                Hola, {{ $customer ?? 'Cliente' }} 👋
              </h1>

              <p style="margin:0 0 16px 0; font-size:14px; line-height:1.6; color:#374151;">
                Gracias por tu compra. Aquí tienes los detalles:
              </p>

              <!-- Customer details -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb; border-radius:10px; overflow:hidden;">
                <tr>
                  <td style="padding:12px 14px; background:#f9fafb; font-size:13px; color:#111827; font-weight:700;">
                    Información del cliente
                  </td>
                </tr>
                <tr>
                  <td style="padding:14px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px; color:#111827;">
                      <tr>
                        <td style="padding:6px 0; color:#6b7280; width:160px;">Cliente</td>
                        <td style="padding:6px 0; font-weight:700;">{{ $customer ?? '-' }}</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0; color:#6b7280;">Email</td>
                        <td style="padding:6px 0; font-weight:700;">{{ $email ?? '-' }}</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0; color:#6b7280;">Método de pago</td>
                        <td style="padding:6px 0; font-weight:700;">
                          @php
                            $pm = $payment_method ?? null;
                            $pmLabel = match((int)$pm) {
                              1 => 'Tarjeta',
                              2 => 'Transferencia',
                              3 => 'Efectivo',
                              default => 'No especificado',
                            };
                          @endphp
                          {{ $pmLabel }}
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <div style="height:16px;"></div>

              <!-- Products -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb; border-radius:10px; overflow:hidden;">
                <tr>
                  <td style="padding:12px 14px; background:#f9fafb; font-size:13px; color:#111827; font-weight:700;">
                    Productos
                  </td>
                </tr>

                <tr>
                  <td style="padding:0 14px 14px 14px;">
                    <!-- Table header -->
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-size:13px; color:#6b7280; margin-top:12px;">
                      <tr>
                        <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:700;">Producto</td>
                        <td align="right" style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:700;">Precio</td>
                        <td align="right" style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:700;">Cant.</td>
                        <td align="right" style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:700;">Subtotal</td>
                      </tr>
                    </table>

                    @php
                      $items = $products ?? [];
                      $total = 0;
                    @endphp

                    <!-- Items -->
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-size:14px; color:#111827;">
                      @forelse($items as $p)
                        @php
                          $name = $p['name'] ?? '-';
                          $price = (float)($p['price'] ?? 0);
                          $qty = (int)($p['quantity'] ?? 0);
                          $subtotal = $price * $qty;
                          $total += $subtotal;
                        @endphp
                        <tr>
                          <td style="padding:12px 0; border-bottom:1px solid #f3f4f6;">
                            <div style="font-weight:700; color:#111827;">{{ $name }}</div>
                          </td>
                          <td align="right" style="padding:12px 0; border-bottom:1px solid #f3f4f6;">
                            ${{ number_format($price, 2) }}
                          </td>
                          <td align="right" style="padding:12px 0; border-bottom:1px solid #f3f4f6;">
                            {{ $qty }}
                          </td>
                          <td align="right" style="padding:12px 0; border-bottom:1px solid #f3f4f6; font-weight:700;">
                            ${{ number_format($subtotal, 2) }}
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="4" style="padding:14px 0; color:#6b7280;">
                            No hay productos para mostrar.
                          </td>
                        </tr>
                      @endforelse
                    </table>

                    <!-- Total -->
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top:12px;">
                      <tr>
                        <td align="right" style="padding-top:10px; font-size:14px; color:#6b7280;">
                          Total
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="padding-top:6px; font-size:20px; font-weight:800; color:#111827;">
                          ${{ number_format($total, 2) }}
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <div style="height:18px;"></div>

              <p style="margin:0; font-size:12px; line-height:1.6; color:#6b7280;">
                Si no reconoces esta compra, responde a este correo para ayudarte.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:16px 24px; background:#f9fafb; border-top:1px solid #e5e7eb;">
              <div style="font-size:12px; color:#6b7280; line-height:1.6;">
                © {{ date('Y') }} Mi App. Todos los derechos reservados.
              </div>
            </td>
          </tr>
        </table>

        <!-- Small spacer -->
        <div style="height:18px;"></div>

        <div style="font-size:11px; color:#9ca3af; font-family: Arial, Helvetica, sans-serif;">
          Este correo es de prueba (SMTP sandbox).
        </div>
      </td>
    </tr>
  </table>
</body>
</html>
