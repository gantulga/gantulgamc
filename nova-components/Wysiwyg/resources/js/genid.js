import Hashids from 'hashids';

export default function(salt) {
    var hashids = new Hashids('yc6wYblYjpELJ+kv/MMJpmip8j02uXCo7HhiOBq0ucs=', 10);

    var id = hashids.encode(new Date().getTime(), Math.floor(Math.random() * 100));

    return id;
}
