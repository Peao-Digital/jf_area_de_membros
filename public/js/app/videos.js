$(document).ready(function () {

  const BtnVoltar = $("#voltarBtn");
  const divEmbed = $("#embed-video");
  const divTitle = $("#aviso_video");
  const toast = document.getElementById('toast');

  toast.classList.add("show");

  const links = {
    1: { copy: "Assista a aula sobre uso do Aplicativo MEU INSS! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=25f03c3e-31b1-41e0-9351-700465ced5d4" },
    2: { copy: "Assista a aula com Dr. Rafael e saiba como lidar com suas dívidas! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=ba25fda7-ee3d-4649-94b4-0ba61a5106d6" },
    3: { copy: "Assista a aula com Dr. Marcus e saiba tudo sobre imóveis! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=26b36ffd-9d6e-43bd-a656-2859a3e80714" },
    4: { copy: "Assista a aula com Ian Alone e saiba escolher o melhor cartão de crédito! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=3ceae569-dbd9-4e40-9f0c-cef5e0fc1586" },
    5: { copy: "Assista a aula com a Dr. Tati Sampaio e saiba tudo sobre a revisão do seu benefício! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=8bdac96e-3d6a-4e97-9c44-b624782b3a75" },
    6: { copy: "Assista a aula com o Átila e saiba como ganhar uma renda extra! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=2490f95b-2eaf-48bc-b6f8-feea329b1003" },
    7: { copy: "Assista a aula com o Ezequiel e saiba como investir e rentabilizar o seu dinheiro! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=601d204d-ce04-4ee3-a340-567db1dd9935" },
    8: { copy: "Assista a aula com o Felipe e saiba como aliviar as suas dores! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=fd50352b-9232-4c51-8c1d-ef5dbf240ad6" },
    9: { copy: "Assista a aula com a Juraci e saiba como ter uma alimentação mais saudável! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=96a212fb-2e93-4fe1-b15f-bac900c87c85" },
    10: { copy: "Assista a aula com o Mathias e saiba como ter mais saúde física! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=9cbc1894-40f1-474c-a4ea-188fbf5d5b1a" },
    12: { copy: "Assista a aula com a Dr. Michele e saiba como ter uma pele de pessego! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=b9c88441-3dd1-4c12-9c09-3bb416bb1f1f" },
    13: { copy: "Assista a aula com o Jr. Marabá e saiba como ter uma vida mais feliz! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=018b0999-c51c-4785-82af-f4e522fd15ec" },
    14: { copy: "Assista a aula com o Renato e saiba como ter uma memória ainda melhor! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=06dea31e-0066-4f4d-b1ba-7337d6be32ae" },
    15: { copy: "Assista a aula com o Dr. Gleison e saiba como ter um sono melhor! Assista clicando no vídeo abaixo:", link: "https://player-vz-03f41f36-332.tv.pandavideo.com.br/embed/?v=55485027-b727-46ca-87f3-407b0f6a7eed" },
  }

  const obter_embed = () => {
    const query = window.location.search;
    const params = new URLSearchParams(query);
    const id = params.get('id');

    divTitle.html(links[id]['copy']);
    divEmbed.append(`<iframe class="embed-responsive-item iframe-video" src="${links[id]['link']}" allowfullscreen></iframe>`);
  }

  BtnVoltar.click(function () {
    window.history.back();
    window.close();
  });

  setTimeout(function () {
    toast.classList.remove("show");
  }, 5000);

  obter_embed();

});