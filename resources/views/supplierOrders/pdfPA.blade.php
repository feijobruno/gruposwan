<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Polymer Solutions</title>
  <link rel="stylesheet" href="css/style_invoice_pa.css" type="text/css" media="all" />
</head>
<body>
  <div>
    <div class="py-4">
      <div class="px-14 py-6">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-full align-top">
                <div>
                  <img src="img/logo_pa.png" class="h-12" />
                </div>
              </td>

              <td class="align-top">
                <div class="text-sm">
                  @forelse ($order as $row)  
                  <table class="border-collapse border-spacing-0">
                    <tbody>
                      <tr>
                        <td class="border-r pr-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Fecha</p>
                            <p class="whitespace-nowrap font-bold text-main text-right">{{ $row->order_date ? date('d/m/Y', strtotime($row->order_date)) : null }}</p>
                          </div>
                        </td>
                        <td class="pl-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Pedido nº:</p>
                            <p class="whitespace-nowrap font-bold text-main text-right">{{ $row->order }}</p>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-slate-100 px-14 py-6 text-sm">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-1/2 align-top">
                <div class="text-sm text-neutral-600">
                  <p class="font-bold">Polymer Additives</p>
                  <p>INVOICING ADDRESS</p>
                  <p>PolymerAdditives S.L.</p>
                  <p>46005 Valencia</p>
                  <p>Tel.: +34 607 04 04 81</p>
                  <p>CIF: ES B66762162</p>
                </div>
              </td>
              <td class="w-1/2 align-top text-right">
                <div class="text-sm text-neutral-600">
                  <p>PROVEEDOR</p>
                  <p class="font-bold">TOLSA SA</p>
                  <p>Núñez de Balboa, 51</p>
                  <p>28001 - Madrid</p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <table class="w-full border-collapse border-spacing-0">
          <thead>
            <tr>
     
              <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Referencia</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Cantidad (Kg)</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Formato</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Precio (€/KG)</td>
            </tr>
          </thead>
          <tbody>
            <tr>
             
              <td class="border-b py-3 pl-2">ADINS FIREPROOF 80T</td>
              <td class="border-b py-3 pl-2 text-right">100</td>
              <td class="border-b py-3 pl-2 text-right"></td>
              <td class="border-b pr-4 text-right">16,692</td>

            </tr>
            <tr>
              <td colspan="7">
                <table class="w-full border-collapse border-spacing-0">
                  <tbody>
                    <tr>
                      <td class="w-full"></td>
                      <td>
                        <table class="w-full border-collapse border-spacing-0">
                          <tbody>
                            <tr>
                              <td class="border-b p-3"
                                class="whitespace-nowrap text-slate-400">
                                FECHA: ASAP</td>
                                <td class="border-b p-3">
                              
                                <div class="whitespace-nowrap text-slate-400">TOTAL:</div>
                              </td>
                              <td class="border-b p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">1.669,20</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="border-b p-3" class="whitespace-nowrap text-slate-400"></td>
                              <td class="p-3">
                                <div class="whitespace-nowrap text-slate-400">IVA 21%:</div>
                              </td>
                              <td class="p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">350,53</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="border-b p-3" class="whitespace-nowrap text-slate-400"></td>
                              <td class="bg-main p-3">
                                <div class="whitespace-nowrap font-bold text-white">EUR:</div>
                              </td>
                              <td class="bg-main p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-white">2.019,73</div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="bg-slate-100 px-14 py-6 text-sm">
      <table class="w-full border-collapse border-spacing-0">
        <tbody>
          <tr>
            <td class="w-1/2 align-top">
              <div class="text-sm text-neutral-600">
                <p class="font-bold">DELIVERY ADDRESS</p>
                <p>PINTURAS COLAMINA S.L.</p>
                <p>CARRETERA ARTICA S/N<</p>
                <p>46005 Valencia</p>
                <p>Tel.: +34 607 04 04 81</p>
                <p>E-31013 - ANSOAIN-ARTICA-PAMPLONA</p>
              </div>
            </td>
            <td class="w-1/2 align-top text-right">
              <div class="text-sm text-neutral-600">
                <p class="font-bold">HORARIO DE ENTREGA</p>
                <p>08:00h - 13:00h</p>
                <p>15:00h - 18:30h</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="px-14 py-10 text-sm text-neutral-700">
        <p class="text-main font-bold">Notas</p>
        <p class="italic">LPrecio DDP Pamplona(€/kg)</p>
        <p class="italic">Condiciones de Pago: 60 días FF</p>
     </div>

     <div class="px-14 py-10 text-sm text-neutral-700">
        <p class="italic">En caso de incrementos severos e inesperados de costes de materias primas, transporte, tasa de cambio, etc., los precios podrán ser modificados con 1 mes de antelación</p>
        <p class="italic">Hojas técnicas y de Seguridad están disponibles. Una vez recibida una orden formal, se comunicará confirmaciónde entrega</p>
     </div>
     @empty
     <tr>
         <td colspan="4" style="border: 1px solid #ccc; text-align: center; color: #f00;">Nenhum usuário encontrado!</td>
     </tr>
     @endforelse
        <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
          Polymer Solutions
          <span class="text-slate-300 px-2">|</span>
          administracion@polymersolutions.es
          <span class="text-slate-300 px-2">|</span>
          (+34) 618 661 127
        </footer>
      </div>
    </div>
</body>

</html>