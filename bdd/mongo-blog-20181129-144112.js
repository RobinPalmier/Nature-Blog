
/** article indexes **/
db.getCollection("article").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** commentaire indexes **/
db.getCollection("commentaire").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** user indexes **/
db.getCollection("user").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** article records **/
db.getCollection("article").insert({
  "_id": ObjectId("5bfe640f60a8d4a43e000030"),
  "titre": "Article n°1",
  "message": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean molestie et justo sed dapibus. Sed tempus at tellus nec venenatis. Mauris ac maximus tellus, quis vehicula urna. Duis scelerisque et quam vitae ornare. Quisque varius tortor in justo pulvinar, nec hendrerit nulla malesuada. Maecenas porttitor felis mauris. Fusce metus arcu, pulvinar non bibendum non, ornare quis purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras et lorem ut massa vulputate consectetur id rhoncus dolor.\r<br/>\r<br/>In hac habitasse platea dictumst. Nulla sollicitudin orci eget efficitur tristique. Donec efficitur pharetra felis aliquam commodo. Fusce dignissim, urna nec semper consectetur, ex neque tristique massa, in vehicula ligula felis sit amet lectus. Donec id tellus ex. Praesent vel suscipit est. Etiam convallis orci eu cursus luctus. Duis placerat sagittis nibh vitae aliquam. Etiam laoreet tellus dolor, a sagittis nisi interdum eget. Nullam tincidunt non nisi sodales ultrices. Donec eu sapien quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum sem arcu, eu egestas lectus cursus quis.\r<br/>\r<br/>Praesent quis pretium libero. Maecenas consequat enim magna. Maecenas at sapien ex. Suspendisse congue nec arcu nec posuere. Nulla vestibulum dolor in ipsum luctus aliquet. Sed lobortis nec velit vel blandit. Pellentesque a sollicitudin nibh. In eleifend eros tellus, quis mollis velit luctus quis. Quisque vehicula libero at dui ultricies, et mattis leo interdum. Sed sed eros a orci ultrices accumsan nec et massa. Nulla neque nisi, volutpat non mi accumsan, vestibulum fringilla lacus. Donec lorem sem, fringilla sed augue quis, tincidunt dapibus nisl. Suspendisse vestibulum tincidunt nisi, eu fringilla risus pretium sed. Aliquam commodo ex at porta feugiat.",
  "date": "28/11/2018",
  "image": "1543398414_9292Desert.jpg",
  "auteur": "Robin Palmier"
});
db.getCollection("article").insert({
  "_id": ObjectId("5bfe643560a8d4f43a00002a"),
  "titre": "Article n°2",
  "message": "Aenean lacinia diam justo, quis feugiat ipsum molestie vitae. Integer condimentum sodales nisl, varius suscipit ligula dictum quis. Sed congue neque leo, vel aliquam nisi ornare eu. Mauris sed turpis id massa pretium placerat. Maecenas rhoncus, metus sed efficitur eleifend, neque diam aliquet libero, vel feugiat dui dui lacinia felis. Vivamus interdum felis urna, eget sagittis tellus porta vel. Maecenas suscipit lacus metus, nec aliquet quam dictum sed. Sed egestas finibus nunc, ut ultricies mauris feugiat non. Ut faucibus lobortis vestibulum. Vestibulum sollicitudin at purus venenatis euismod. Phasellus vel ante non risus posuere viverra dapibus nec turpis. Fusce vitae nulla a ligula egestas viverra ac sit amet turpis. Ut maximus sagittis ipsum at pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r<br/>\r<br/>Nulla et neque a orci sagittis tincidunt. Proin porttitor porta eros, sit amet dignissim ipsum maximus ac. Fusce ullamcorper lectus eros, a euismod massa vestibulum vel. Duis egestas venenatis efficitur. Nunc faucibus justo sed consectetur elementum. Proin gravida ipsum orci, eget molestie ipsum tempor quis. Pellentesque pharetra vehicula lectus eu fermentum. Cras purus dolor, auctor eget vestibulum et, sodales vitae lacus. Curabitur congue, enim ac tincidunt semper, dolor nisl molestie mauris, accumsan suscipit elit magna nec justo. Cras sed velit tempor, viverra nunc et, ornare eros.\r<br/>\r<br/>Proin convallis tempor fermentum. Etiam ornare nulla bibendum dui varius, a ultrices erat faucibus. Aliquam vitae nunc libero. Ut sodales tellus nisi, ac euismod est gravida non. Aliquam eget neque sagittis, malesuada nisl sed, lacinia mi. Sed tincidunt tempus vulputate. Cras lorem est, feugiat et risus sit amet, molestie aliquam nibh. Vivamus porta egestas porta. Cras sit amet neque vitae orci dapibus interdum eget id tortor. Pellentesque ut tempus erat, vel tempor quam. Fusce nulla felis, volutpat vitae finibus quis, hendrerit convallis erat. Nam dapibus nulla eu felis imperdiet sagittis. Cras non arcu nulla. Nulla convallis laoreet odio ut porta. Aliquam vehicula mattis urna at sodales.",
  "date": "28/11/2018",
  "image": "1543398452_3050Lighthouse.jpg",
  "auteur": "Robin Palmier"
});
db.getCollection("article").insert({
  "_id": ObjectId("5bfe645160a8d4a43e000031"),
  "titre": "Article n°3",
  "message": "Nulla volutpat bibendum orci nec ullamcorper. Vestibulum accumsan lacus nec sem volutpat posuere. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras diam augue, consectetur eu ante non, ultrices ultrices turpis. Suspendisse varius velit eu tortor lobortis, quis facilisis leo semper. Aliquam eget placerat magna. Aliquam id dui nec tortor pulvinar ornare. Quisque imperdiet placerat fermentum. Duis ullamcorper tellus vitae nisl sollicitudin ullamcorper.\r<br/>\r<br/>Duis quis pulvinar odio. Mauris aliquet risus tincidunt, finibus elit sed, tristique sem. Maecenas eleifend faucibus tortor, eget faucibus mi blandit ut. Vestibulum ac facilisis tortor, nec tempor felis. Sed ornare congue massa, sit amet finibus diam vehicula ac. Vestibulum tempus, risus eget lobortis faucibus, nisl nunc ultricies justo, a ultrices augue lacus non ante. Pellentesque id sagittis nisi, sed blandit arcu. Phasellus quis sodales dolor, sit amet aliquam enim. Phasellus maximus sed nibh eu cursus. Fusce aliquet mauris massa, sit amet faucibus elit dapibus ac.\r<br/>\r<br/>Suspendisse viverra vitae metus a tincidunt. Praesent varius vestibulum leo, ac imperdiet urna ullamcorper at. Etiam hendrerit ipsum id dignissim vestibulum. Cras finibus turpis vitae tellus consectetur, ut mattis ipsum accumsan. In pulvinar vel arcu at ornare. Donec auctor nisl vitae risus varius, ut hendrerit neque aliquam. Sed non risus sit amet ex blandit semper. Nullam non nulla vitae sem laoreet vulputate vitae eget leo. Donec aliquet libero ut urna pharetra lobortis.",
  "date": "28/11/2018",
  "image": "1543398480_5221Penguins.jpg",
  "auteur": "Robin Palmier"
});

/** commentaire records **/
db.getCollection("commentaire").insert({
  "_id": ObjectId("5bfe6cf460a8d43423000034"),
  "nom": "Palmier",
  "prenom": "Robin",
  "datePost": "28/11/2018 à 11:24",
  "commentaire": "L&#039;article est vraiment super !",
  "idArticle": "5bfe640f60a8d4a43e000030"
});
db.getCollection("commentaire").insert({
  "_id": ObjectId("5bfe6d3360a8d4983e00002b"),
  "nom": "Palmier",
  "prenom": "Robin",
  "datePost": "28/11/2018 à 11:25",
  "commentaire": "Super cool !",
  "idArticle": "5bfe643560a8d4f43a00002a"
});

/** system.indexes records **/
db.getCollection("system.indexes").insert({
  "v": NumberInt(2),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "blog.article"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(2),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "blog.user"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(2),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "blog.commentaire"
});

/** user records **/
db.getCollection("user").insert({
  "_id": ObjectId("5bfb0f00457251640700002a"),
  "nom": "Palmier",
  "prenom": "Robin",
  "email": "robinpalmier98@gmail.com",
  "mdp": "$2y$10$0Jw1jT6yJtbGF5alrH3cNO6lJEUz9aEH7yjEHjXAYtmE3pdyBDhLu",
  "statut": NumberInt(1)
});
