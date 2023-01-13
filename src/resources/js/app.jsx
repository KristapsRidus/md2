"use strict";

import React from "react";
import ReactDOM from "react-dom";



class IndexBook extends React.Component {
    toSingle(albumID, e) {
        e.preventDefault();
        this.props.openSingle(albumID);
    }

    render() {
        const album = this.props.album;
        const num = this.props.num;

        const lr = Boolean(num % 2);

        return(
            <div className="row mb-5 pt-5 pb-5 bg-light">
                <div className={"col-md-6 mt-2 px-5 " + (lr ? "text-start order-2" : "text-end order-1")}>
                    <p className="display-4">{album.name}</p>
                    <p className="lead">{album.description.split(' ').slice(0, 32).join(' ')}&hellip;</p>
                    <a className={"btn btn-success see-more " + (lr ? "float-left" : "float-right")} href="#" onClick={(e) => this.toSingle(album.id, e)}>Apskatīt</a>
                </div>
                <div className={"col-md-6 text-center " + (lr ? "order-1" : "order-2")}>
                    <img className="img-fluid img-thumbnail rounded-lg w-50" alt={album.name} src={album.image} />
                </div>
            </div>
        );
    }
}

class SingleAlbum extends React.Component {
    toIndex(e) {
        e.preventDefault();
        // BookApp.openIndex();
        this.props.openIndex();
    }

    render() {
        const album = this.props.album;

        return(
            <div className="row mb-5">
                <div className="col-md-6 pt-5">
                    <h1 className="display-3">{album.name}</h1>
                    <p className="lead">{album.description}</p>
                    <dl className="row">
                        <dt className="col-sm-3">Gads</dt>
                        <dd className="col-sm-9">{album.year}</dd>
                        <dt className="col-sm-3">Cena</dt>
                        <dd className="col-sm-9">&euro; {album.price}</dd>
                        <dt className="col-sm-3">Žanrs</dt>
                        <dd className="col-sm-9">{album.genre}</dd>
                    </dl>
                    <a className="btn btn-dark go-back float-left" href="#" onClick={(e) => this.toIndex(e)}>Uz sākumu</a>
                </div>
                <div className="col-md-6 text-center p-5">
                    <img className="img-fluid img-thumbnail rounded-lg" src={album.image} alt={album.name} />
                </div>
            </div>
        );
    };
}

class RelatedAlbum extends React.Component {
    toSingle(albumID, e) {
        e.preventDefault();
        console.log(this.props);
        this.props.openSingle(albumID);
    }

    render() {
        const album = this.props.album;
        return(
            <div className="col-md-4">
                <div className="card">
                    <img className="card-img-top" src={album.image} alt={album.name} />
                    <div className="card-body">
                        <h5 className="card-title">{album.name}</h5>
                        <a className="btn btn-success see-more" href="#" onClick={(e) => this.toSingle(album.id, e)}>Apskatīt</a>
                    </div>
                </div>
            </div>
        );
    }
}

class RelatedPanel extends React.Component {
    render() {
        const albums = this.props.albums;
        const relatedAlbums = albums.map((album) => <RelatedAlbum album={album} openSingle={this.props.openSingle} />);
        return(
            <div>
                <div className="row mt-5">
                    <div className="col-md-12">
                        <h2 className="display-4">Līdzīgi albumi</h2>
                    </div>
                </div>

                <div className="row mb-5">
                    {relatedAlbums}
                </div>
            </div>
        );
    }
}

class IndexPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {albums: null};
    }

    componentDidMount() {
        fetch('http://localhost/data/get-top-albums')
            .then(data => data.json())
            .then(data => {
                this.setState({
                    albums: data
                });
            });
    }

    render() {
        const albumData = this.state.albums;
        if (albumData) {
            const albumElements = albumData.map((album, index) => <IndexAlbum album={album} num={index} openSingle={this.props.openSingle} />);
            return(albumElements);
        }
    }
}

class SinglePage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            album: null,
            relatedAlbums: null
        };
    }

    componentDidMount() {
        fetch('http://localhost/data/get-album/' + this.props.albumID)
            .then(data => data.json())
            .then(data => {
                this.setState({
                    album: data
                });
            });

        fetch('http://localhost/data/get-related-albums/' + this.props.albumID)
            .then(data => data.json())
            .then(data => {
                this.setState({
                    relatedAlbums: data
                });
            });
    }

    render() {
        const albumData = this.state.album;
        const relatedAlbumData = this.state.relatedAlbums;
        if (albumData && relatedAlbumData) {
            return(
                <div>
                    <SingleAlbum album={albumData} openIndex={this.props.openIndex} />
                    <RelatedPanel albums={relatedAlbumData} openSingle={this.props.openSingle} />
                </div>
            );
        }
    };
}

class AlbumApp extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedAlbum: null
        };

        this.openIndex = this.openIndex.bind(this);
        this.openSingle = this.openSingle.bind(this);
    }

    openIndex() {
        this.setState({
            selectedAlbum: null
        });
    }

    openSingle(albumID) {
        this.setState({
            selectedAlbum: albumID
        });
    }

    render() {
        const selectedBook = this.state.selectedAlbum;

        let page;
        if (selectedBook == null) {
            page = <IndexPage openSingle={this.openSingle} />
        } else {
            page = <SinglePage albumID={selectedAlbum} openIndex={this.openIndex} openSingle={this.openSingle} />
        }

        return(page);
    }

}

const root = ReactDOM.createRoot(document.getElementById('root'));

root.render(<AlbumApp />);