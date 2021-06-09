<?php

namespace App\Notifications;

use App\Models\Venda;
use App\Services\AnexoService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class RelatorioVendas extends Notification
{
    use Queueable;

    /**
     * @var Venda
     */
    private $vendas;

    /**
     * @var string
     */
    private $anexo;
    /**
     * @var AnexoService
     */
    private $service;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Collection $vendas)
    {
        $this->vendas = $vendas;
        $this->service = new AnexoService();
        $this->anexo = $this->service->anexo(view('vendas.lista')->with(['vendas'=>$this->vendas]));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Relatório de vendas')
                    ->attachData($this->anexo,$this->service->gerarNomeArquivo(),['mime' => 'application/pdf'])
                    ->line("Segue em anexo seu relatório de vendas diário!!")
                    ->line(":)");

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
