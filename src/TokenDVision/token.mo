import Array "mo:base/Array";
import Buffer "mo:base/Buffer";
import Debug "mo:base/Debug";
import Hash "mo:base/Hash";
import HashMap "mo:base/HashMap";
import Int "mo:base/Int";
import Iter "mo:base/Iter";
import List "mo:base/List";
import Nat "mo:base/Nat";
import Option "mo:base/Option";
import P "mo:base/Prelude";
import Prelude "mo:base/Prelude";
import Principal "mo:base/Principal";

actor TokenDVision {
  Debug.print("Hello upgrade");

  let owner: Principal = Principal.fromText("gxbbe-bm24s-hkvpt-bwzbk-4tkd4-m6bdd-ktdc2-feiaj-g5zot-6i24i-3ae");
  
  let totalSupply: Nat = 1000000000;

  let sympol: Text = "DVision";
  private stable var currentPrincipalID = ""; // ID vi cua mot user !!!
  private stable var balanceEntries: [(Principal, Nat)] = [];

  private stable var currentDonateDvision = 0; 

   public func instantiate(PrincipalID : Text) : () {
    currentPrincipalID := PrincipalID;
  };
   public query func getCurrentPrincipal() : async Text {
    // currentPrincipalID := PrincipalID;
    return currentPrincipalID;
  };

    // Lấy tổng số Donate hiện tại
   public query func getCurrentDonateDvision() : async Nat {
    // currentPrincipalID := PrincipalID;
    return currentDonateDvision;
  };

  // Sổ cái để lưu trữ (tài khoản ++ số tiền balances);
  private var balances = HashMap.HashMap<Principal, Nat>(1, Principal.equal, Principal.hash);
  // Sổ cái lưu trữ (ID Dự án và số tiền của dự án đó);
  private var donateTokenIDMaps = HashMap.HashMap<Nat, Nat>(1, Nat.equal, Hash.hash);
  

  if(balances.size() < 1) {
     balances.put(owner, totalSupply); 
  };
  

  public query func showEntries(): async [(Principal, Nat)] {
    return Iter.toArray(balances.entries());
  };

  public shared(msg) func whoCaller(): async Text {
    return Principal.toText(msg.caller);
  };

  public query func balanceOfId_(ProjectID_: Nat ): async Nat {
    // let PrincipalID = Principal.fromText(who); 
   let balance: Nat = switch(donateTokenIDMaps.get(ProjectID_)) {
      case(null) {
        return 0;
      };
      case(?result) {
        return result;
      };
    };
    return balance;
  };


  // Lấy số tiền của ID hiện tại
  public query func balanceOf(who: Principal): async Nat {
    // let PrincipalID = Principal.fromText(who); 
   let balance: Nat = switch(balances.get(who)) {
      case(null) {
        return 0;
      };
      case(?result) {
        return result;
      };
    };
    return balance;
  };

  public query func getSympol(): async Text {
    return sympol;
  };

  public  shared(msg) func payOut(): async Text {
      Debug.print("reciper: "#debug_show(msg.caller));
      // 
      switch(balances.get(msg.caller)) {
        case(null) {
          let amount = 10000;
          // balances.put(msg.caller,amount);
          let result = await transfer(msg.caller, amount);
          return result;
        };
        case(?something) {
          return "Already claimed";
        }
      }
  };

  

  public shared(msg) func transfer(to: Principal, amount: Nat): async Text {
      Debug.print( "who sent: " #debug_show( msg.caller));
      let fromBalance = await balanceOf(msg.caller);
      if(fromBalance >= amount) {

      let newFromBalance: Nat = fromBalance - amount;
      balances.put(msg.caller, newFromBalance);
      
      let toBalance = await balanceOf(to);
      let newToBalance = toBalance + amount;
      balances.put(to, newToBalance);
        return "sucess transfer";
      } else {
        return "inincipient token to transfer!";
      }
  };


  
  public  func DonateFundToken(toID: Nat, amount: Nat): async Text {
      // Debug.print( "who sent: " #debug_show(msg.caller));
      let currentPrincipalID = Principal.fromText(await getCurrentPrincipal());
      let fromBalance = await balanceOf(currentPrincipalID);
      if(fromBalance >= amount) {

      let newFromBalance: Nat = fromBalance - amount;
      balances.put(currentPrincipalID, newFromBalance);

      currentDonateDvision += amount;

      // let balanceOfToID_ = 
      let toBalance = await balanceOfId_(toID);
      // Error ở đây !!!
      let newToBalance = toBalance + amount;
      donateTokenIDMaps.put(toID, newToBalance);
        return "sucess transfer";
      } else {
        return "inincipient token to transfer!";
      }
  };

  public query func sizeOfDonateTokenMaps(): async Nat {
    return donateTokenIDMaps.size();
  };

   public query func view_all_donateTokenMap() : async [(Nat, Nat)] {
    return Iter.toArray(donateTokenIDMaps.entries());
  };

  public func transferFromSystem(to: Principal, amount: Nat): async Text {
      // Debug.print( "who sent: " #debug_show( msg.caller));
      // ljfhw-dxosx-htxdm-ifyr5-2d56z-mvviv-5vvhs-4g6g5-fdemu-owdfc-qae
      let PrincipalIDText = "gxbbe-bm24s-hkvpt-bwzbk-4tkd4-m6bdd-ktdc2-feiaj-g5zot-6i24i-3ae";
      let fromBalance = await balanceOf(Principal.fromText(PrincipalIDText));
      if(fromBalance >= amount) {
      let newFromBalance: Nat = fromBalance - amount;
      
      balances.put(Principal.fromText(PrincipalIDText), newFromBalance);
      
      let toBalance = await balanceOf(to);
      let newToBalance = toBalance + amount;
      balances.put(to, newToBalance);
        return "sucess transfer";
      } else {
        return "inincipient token to transfer!";
      }
  };
  // Trước khi update canister
  system func preupgrade() {
    balanceEntries := Iter.toArray(balances.entries());
  };

  // Sau khi deploy canister
  system func postupgrade() {
    balances:= HashMap.fromIter<Principal, Nat>(balanceEntries.vals(), 1, Principal.equal, Principal.hash);
    // balanceEntries := [];
  };

}